// routes/catalogue.js

var express = require('express');
var router = express.Router();
var Catalogue = require('./Include/Catalogue');

/**
 * GET Catalogue Page
 */
router.get('/catalogue', function(req, res) {
	res.render('catalogue');
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