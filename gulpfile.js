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

gulp.task('default', ['jslibs', 'javascript', 'fonts', 'csslibs', 'css', 'watch'], function(){
  //gulp.start()
});


var libsJavascript = [
  'bower/jquery-validation/dist/jquery.validate.min.js',
  'bower/jquery-ui/ui/datepicker.js',
  'vendor/twbs/bootstrap/dist/js/bootstrap.min.js',
  'vendor/twbs/bootstrap/assets/js/jquery.js'
];

var libsCss = [
  'vendor/twbs/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/jquery-datetimepicker/jquery.datetimepicker.css'
];

/*
* Configuración de la tarea 'demo'
*/
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
    gulp.watch('assets/css/*.css', ['css'], function(){
          console.log('css done!');
    });

    gulp.watch('assets/js/*.js', ['javascript'], function(){
      
    });
});
