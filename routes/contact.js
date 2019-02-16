// routes/contact.js

var express = require('express');
var router = express.Router();

/**
 * GET Contact Page
 */
router.get('/contact', function(req, res) {
	res.render('index', {
		scrollTo: 6
	});
});

module.exports = router;