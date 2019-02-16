// routes/index.js

var express = require('express');
var router = express.Router();

/**
 * GET Home Page
 */
router.get('/', function(req, res) {
	res.render('index', {
		scrollTo: 1
	});
});

module.exports = router;