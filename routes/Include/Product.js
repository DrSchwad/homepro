var Promise = require("bluebird");

var dbConfig = require.main.require('./config/database');
var mysql = require("mysql");
var connection;
function handleDisconnect() {
	connection = Promise.promisifyAll(mysql.createConnection(dbConfig.connection)); // Recreate the connection, since
                                                                                    // the old one cannot be reused.

	return connection.connectAsync()
		.then(function(err) {    // The server is either down
			if(err.code) {       // or restarting (takes a while sometimes).
				setTimeout(handleDisconnect, 2000); // We introduce a delay before attempting to reconnect,
			}                                       // to avoid a hot loop, and to allow our node script to
			                                        // process asynchronous requests in the meantime.
			                                        // If you're also serving http, display a 503 error.
			else {
				connection.on('error', function(err) {
					console.log('Db error', err);
					if(err.code === 'PROTOCOL_CONNECTION_LOST') { // Connection to the MySQL server is usually
						handleDisconnect();                       // lost due to either server restart, or a
					} else {                                      // connnection idle timeout (the wait_timeout
						throw err;                                // server variable configures this)
					}
				});
				return connection.queryAsync('USE ' + dbConfig.database);
			}
		});
}

var sizeOf = Promise.promisify(require('image-size'));

/* Returns total products under this category */
var getProducts = function(category, productNo) {
	var queryString = "SELECT * FROM "+ dbConfig.productCategories + " WHERE name = ?", queryParams = [category];
	if (category === "All") {
		queryString = "SELECT * FROM "+ dbConfig.productCategories;
		queryParams = [];
	}
	var ret = {
		totalProducts: 0,
		categoryId: 0,
		categories: [],
		categoryCodes: [],
		titles: [''],
		dimensions: []
	};
	return handleDisconnect()
		.then(function() {
			return connection.queryAsync(queryString, queryParams);
		})
		.then(function(rows) {
			return Promise.resolve(rows)
				.each(function(row) {
					return handleDisconnect()
						.then(function() {
							return connection.queryAsync("SELECT title FROM " + dbConfig.products + " WHERE category = ?", [row.id]);
						})
						.then(function(titles) {
							titles.forEach(function (title) {
								ret.titles.push(title['title']);
							});
						});
				})
				.then(function() {
					return rows;
				})
		})
		.then(function(rows) {
			if (category !== "All" && rows.length !== 1) throw "Category not found!";
			if (category !== "All") ret.categoryId = rows[0].id;
			var dimensionsToGet = [];
			for (var i = 0; i < rows.length; i++) {
				ret.totalProducts += rows[i]['total_items'];
				ret.categories.push({
					name: rows[i].name,
					till: ret.totalProducts
				});
				ret.categoryCodes.push(rows[i].code);
				for (var j = 1; j <= rows[i]['total_items']; j++) dimensionsToGet.push({
					id: j,
					category: rows[i]['name']
				});
			}
			if (ret.totalProducts < productNo) throw "Product out of bound!";
			return dimensionsToGet;
		})
		.each(function(item) {
			return sizeOf('./public/img/product/' + item.category + '/' + item.id + '.png')
				.then(function (dimensions) {
					ret.dimensions.push({
						height: dimensions.height,
						width: dimensions.width
					});
				});
		})
		.then(function() {
			return ret;
		})
		.catch(function (e) {
			console.log(e);
			return false;
		});
};

module.exports = {
	getProducts: getProducts
};