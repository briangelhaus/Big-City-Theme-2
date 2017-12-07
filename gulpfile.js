var gulp = require('gulp');
var browserSync = require('browser-sync');

gulp.task('default', function() {
	var files = [
		'./style.css',
		'./css/*.css',
		'./js/*.js',
		'./*.php',
		'./includes/*.php',
		'./woocommerce/*.php'
	];
	browserSync.init(files, {
		proxy: "local.bigcity2.com",
		notify: true,
	});

	gulp.watch([
		'./style.css',
		'./css/*.css',
		'./js/*.js',
		'./*.php',
		'./includes/*.php',
		'./woocommerce/*.php'
	]);
});