/*jslint node: true */
"use strict";

var $           = require('gulp-load-plugins')();
var argv        = require('yargs').argv;
var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var cleanCSS    = require('gulp-clean-css');


// Enter URL of your local server here
// Example: 'http://localwebsite.dev'
var URL = 'http://tootopia.dev';

// Check for --production flag
var isProduction = !!(argv.production);

// Browsers to target when prefixing CSS.
var COMPATIBILITY = [
  'last 2 versions',
  'ie >= 9',
  'Android >= 2.3'
];

// File paths to various assets are defined here.
var PATHS = {
  javascript: [
    // Include your own custom scripts (located in the custom folder)
    'assets/js/*.js',
  ]
};


gulp.task('sass', function() {
  return gulp.src('assets/scss/**/*.scss')
  .pipe($.sourcemaps.init())
  .pipe($.sass({
    errLogToConsole: true
  }))
  .on('error', $.notify.onError({
      message: "<%= error.message %>",
      title: "Sass Error"
  }))
  .pipe($.autoprefixer({
      browsers: COMPATIBILITY
  }))
  .pipe($.if(isProduction, cleanCSS()))
  .pipe($.if(!isProduction, $.sourcemaps.write('.')))
  .pipe(gulp.dest('assets/stylesheets'))
  .pipe(browserSync.stream({match: '**/*.css'}));
});


// Combine JavaScript into one file
// In production, the file is minified
gulp.task('javascript', function() {
  var uglify = $.uglify()
    .on('error', $.notify.onError({
      message: "<%= error.message %>",
      title: "Uglify JS Error"
    }));

  return gulp.src(PATHS.javascript)
    .pipe($.sourcemaps.init())
    .pipe($.concat('vender.js', {
      newLine:'\n;'
    }))
    .pipe($.if(isProduction, uglify))
    .pipe($.if(!isProduction, $.sourcemaps.write()))
    .pipe(gulp.dest('assets/javascript'))
});


// Browsersync task
gulp.task('browser-sync', function() {

  var files = [
            '**/*.php',
            'assets/images/**/*.{png,jpg,gif}',
          ];

  browserSync.init(files, {
    // Proxy address
    proxy: URL
  });
});


gulp.task('default', ['browser-sync', 'sass'], function(){

  // Sass Watch
  gulp.watch(['assets/scss/**/*.scss'], ['sass']);

});