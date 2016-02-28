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

gulp.task('default', ['javascript']);


var nodeJavascript = [
'node_modules/validate.js/validate.min.js','vendor/twbs/bootstrap/dist/js/bootstrap.min.js',
'vendor/twbs/bootstrap/assets/js/jquery.js'
];

/*
* Configuración de la tarea 'demo'
*/
gulp.task('javascript', [], function () {
    nodeJavascript.forEach(function(script){
      gulp.src(script)
      .pipe(gulp.dest('web/js/'));
    });
});