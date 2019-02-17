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

/* Returns data of all products */
var getProducts = function() {
	var ret = {};
	var categories = {};
	return handleDisconnect()
		.then(function() {
			return connection.queryAsync("SELECT id, name FROM " + dbConfig.productCategories, []);
		})
		.then(function(rows) {
			return rows;
		})
		.each(function(row) {
			ret[row['id']] = {};
			categories[row['id']] = row['name'];
		})
		.then(function() {
			return connection.queryAsync("SELECT * FROM " + dbConfig.products, []);
		})
		.then(function(rows) {
			rows.forEach(function(row) {
				ret[row['category']][row['serial']] = row;
			});
			return rows;
		})
		.each(function(row) {
			return sizeOf('./public/img/product/' + categories[row['category']] + '/' + row['serial'] + '.png')
				.then(function (dimensions) {
					ret[row['category']][row['serial']]['height'] = dimensions.height;
					ret[row['category']][row['serial']]['width'] = dimensions.width;
					ret[row['category']][row['serial']]['category'] = categories[row['category']];
				});
		})
		.then(function () {
			return ret;
		})
		.catch(function (e) {
			console.log(e);
			return false;
		});
};

var getCategoryId = function(category) {
	if (category === "All") return Promise.resolve(0);
	return handleDisconnect()
		.then(function() {
			return connection.queryAsync("SELECT id FROM " + dbConfig.productCategories + " WHERE name = ?", [category]);
		})
		.then(function(rows) {
			if (rows.length !== 1) throw "Category not found!";
			return parseInt(rows[0]['id']);
		})
		.catch(function (e) {
			console.log(e);
			return false;
		});
};

module.exports = {
	getProducts: getProducts,
	getCategoryId: getCategoryId
};