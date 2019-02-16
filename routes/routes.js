// app/routes.js

module.exports = function(app) {
	app.use('/', require('./index'));
	app.use('/', require('./contact'));
	app.use('/', require('./catalogue'));
	app.use('/', require('./product'));
    app.use('/', require('./404'));
};