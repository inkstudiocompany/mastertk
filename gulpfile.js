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
    watch = require('gulp-watch');

gulp.task('default', ['jslibs', 'javascript', 'fonts', 'csslibs', 'css']);


var libsJavascript = [
  'node_modules/jquery-validation/dist/jquery.validate.js','vendor/twbs/bootstrap/dist/js/bootstrap.min.js',
  'vendor/twbs/bootstrap/assets/js/jquery.js'
];

var libsCss = [
  'vendor/twbs/bootstrap/dist/css/bootstrap.min.css'
];

/*
* Configuración de la tarea 'demo'
*/
gulp.task('jslibs', [], function () {
    libsJavascript.forEach(function(script){
      gulp.src(script)
      .pipe(gulp.dest('web/js/'));
    });
});

gulp.task('csslibs', [], function () {
    libsCss.forEach(function(script){
      gulp.src(script)
      .pipe(gulp.dest('web/css/'));
    });
});

gulp.task('css', [], function () {
  watch('assets/css/*.css', function(){
    gulp.src('assets/css/*.css')
    .pipe(concat('application.css'))
    .pipe(uglifycss())
    .pipe(gulp.dest('web/css/'));
  });
});

gulp.task('javascript', [], function () {
  watch('assets/js/*.js', function(){
    gulp.src('assets/js/*.js')
    .pipe(concat('application.js'))
    .pipe(uglify())
    .pipe(gulp.dest('web/js/'));
  });
});

gulp.task('fonts', [], function () {
    gulp.src('vendor/twbs/bootstrap/dist/fonts/*')
    .pipe(gulp.dest('web/fonts/'));
});