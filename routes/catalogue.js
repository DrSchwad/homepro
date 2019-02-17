// routes/catalogue.js

var express = require('express');
var router = express.Router();
var Catalogue = require('./Include/Catalogue');

/**
 * GET Catalogue Page
 */
router.get('/catalogue', function(req, res) {
	res.render('catalogue', {
		category: 0
	});
});
router.get('/catalogue/:cat', function(req, res) {
	Catalogue.getCategoryId(req.params['cat']).then(function (category) {
		if (category !== false) res.render('catalogue', {
			category: category
		});
		else res.redirect('/404');
	});
});


/**
 * GET Products Data
 */
router.post('/catalogue', function(req, res) {
	Catalogue.getProducts().then(function (products) {
		res.send(products);
	});
});

module.exports = router;