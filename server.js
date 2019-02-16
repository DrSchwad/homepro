// server.js

// set up ======================================================================
// get all the tools needed
var express  = require('express');
var bodyParser = require('body-parser');
var morgan = require('morgan');
var path = require("path");
var app      = express();
var port     = process.env.PORT || 8080;

// configuration ===============================================================

// set up express application
app.use(morgan('dev')); // log every request to the console
app.use(bodyParser.urlencoded({
	extended: true
}));
app.use(bodyParser.json());
app.set('view engine', 'ejs'); // set up ejs for templating

// routes ======================================================================
app.use(express.static(__dirname + '/public'));
app.set('views', __dirname + '/views');

// launch ======================================================================
var server = require('http').Server(app);
server.listen(port);
console.log('Server running on port ' + port);
require('./routes/routes.js')(app); // load the routes and pass in the app