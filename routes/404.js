// routes/404.js

var express = require('express');
var router = express.Router();

/**
 * GET 404 Page
 */
router.get('/404', function(req, res) {
	res.render('404');
});

module.exports = router;