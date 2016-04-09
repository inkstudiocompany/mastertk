'use strict'
/**
* Gulp File
* Version 1.0
*/

/*
* Dependencies
*/
var gulp = require('gulp'),
  	concat = require('gulp-concat'),
  	uglifycss = require('gulp-uglifycss'),
  	uglify = require('gulp-uglify'),
    batch = require('gulp-batch'),
    watch = require('gulp-watch');

gulp.task('default', ['images', 'jslibs', 'javascript', 'fonts', 'csslibs', 'css', 'watch'], function(){
  //gulp.start()
});


var libsJavascript = [
/*
    'vendor/twbs/bootstrap/assets/js/jquery.js',
    'node_modules/jquery-validation/dist/jquery.validate.js',
    'vendor/twbs/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js',
    'node_modules/jquery-ui/jquery-ui.js'
*/
  'bower/jquery-validation/dist/jquery.validate.min.js',
  'bower/bootstrap3-datepicker/js/bootstrap-datepicker.js',
    'bower/bootstrap3-datepicker/js/locales/bootstrap-datepicker.es.js',
  'bower/jquery-steps/build/jquery.steps.min.js',
  'bower/bootstrap3-typeahead/bootstrap3-typeahead.min.js',
  'bower/bootstrap-switch/dist/js/bootstrap-switch.min.js',
  'vendor/twbs/bootstrap/dist/js/bootstrap.min.js',
  'vendor/twbs/bootstrap/assets/js/jquery.js'
];

var libsCss = [
  'vendor/twbs/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/jquery-datetimepicker/jquery.datetimepicker.css',
    'bower/bootstrap3-datepicker/css/datepicker.css',
    'bower/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
    'bower/jquery-steps/demo/css/jquery.steps.css'
];

/*
* Configuración de la tarea 'demo'
*/
gulp.task('images', [], function () {
    return gulp.src('assets/images/*.*')
        .pipe(gulp.dest('web/images/'))
});

gulp.task('jslibs', [], function () {
    return gulp.src(libsJavascript)
      .pipe(gulp.dest('web/js/'))
});

gulp.task('csslibs', [], function () {
    return gulp.src(libsCss)
      .pipe(gulp.dest('web/css/'))
});

gulp.task('css', [], function () {
  return gulp.src('assets/css/*.css')
    .pipe(concat('application.css'))
    .pipe(uglifycss())
    .pipe(gulp.dest('web/css/'))
});

gulp.task('javascript', [], function () {
  return gulp.src('assets/js/*')
    .pipe(concat('application.js'))
    //.pipe(uglify())
    .pipe(gulp.dest('web/js/'))
});

gulp.task('fonts', [], function () {
    return gulp.src('vendor/twbs/bootstrap/dist/fonts/*')
    .pipe(gulp.dest('web/fonts/'))
});

gulp.task('watch', function () {
    gulp.watch('assets/images/*.*', ['images'], function(){

    });

    gulp.watch('assets/css/*.css', ['css'], function(){
          console.log('css done!');
    });

    gulp.watch('assets/js/*.js', ['javascript'], function(){
      
    });
});
