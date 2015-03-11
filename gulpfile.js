var less = require('gulp-less'),
	path = require('path'),
	gulp = require('gulp'),
	LessPluginCleanCSS = require('less-plugin-clean-css'),
	cleancss = new LessPluginCleanCSS({ advanced: true }),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps = require('gulp-sourcemaps');

gulp.task('less', function () {

  return gulp.src(['./assets/less/main.less'])
  	.pipe(sourcemaps.init())
    .pipe(less({
      plugins: [],
    }))
   //  .pipe( autoprefixer({
		 // browsers: ['last 2 versions'],
		 // cascade: false
   //  }) )
    .pipe( sourcemaps.write('./assets/css') )
    .pipe( gulp.dest( './assets/css' ) );

});

gulp.task('bootstrap', function(){

  return gulp.src(['./assets/less/_bootstrap.less'])
    .pipe(less({
      plugins: [cleancss],
    }))
    .pipe( gulp.dest( './assets/css' ) );

});

gulp.task('dev', function(){

	// Css
  return gulp.src(['./assets/less/main.less'])
  	.pipe( sourcemaps.init() )
    .pipe( less() )
    .pipe( sourcemaps.write('./assets/css') )
    .pipe( gulp.dest( './assets/css' ) );

});

gulp.task('dist', ['bootstrap'], function () {

	// Css
  return gulp.src(['./assets/less/main.less'])
  	.pipe( sourcemaps.init() )
    .pipe(less())
    .pipe( autoprefixer({
		 browsers: ['last 2 versions'],
		 cascade: false
    }) )
    .pipe( sourcemaps.write('./assets/css') )
    .pipe( gulp.dest( './assets/css' ) );



});