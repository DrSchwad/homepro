// routes/product.js

var express = require('express');
var router = express.Router();
var Product = require('./Include/Product');

/**
 * GET Product Page
 */
router.get('/product', function(req, res) {
	res.redirect('/product/All/1');
});
router.get('/product/:cat', function(req, res) {
	res.redirect('/product/' + req.params['cat'] + '/1');
});
router.get('/product/:cat/:item', function(req, res) {
	Product.getProducts(req.params['cat'], req.params['item']).then(function (products) {
		if (products.totalProducts !== false) res.render('product', {
			at: req.params['item'],
			total: products.totalProducts,
			categoryId: products.categoryId,
			categories: products.categories,
			dimensions: products.dimensions
		});
		else res.redirect('/404');
	});
});

module.exports = router;