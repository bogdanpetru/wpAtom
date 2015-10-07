var less = require('gulp-less');
var path = require('path');
var gulp = require('gulp');
var LessPluginCleanCSS = require('less-plugin-clean-css');
var cleancss = new LessPluginCleanCSS({ advanced: true });
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var livereload = require('gulp-livereload');
var notify = require('gulp-notify');



gulp.task('less', function () {

  return gulp.src(['./assets/less/main.less'])
    .pipe(sourcemaps.init())
    .pipe(
      less()
      .on("error", notify.onError(function (error) {
          return "Message to the notifier: " + error.message;
       }))
    )

    .pipe( sourcemaps.write('./') )
    .pipe( gulp.dest( './assets/css/' ) )
    .pipe( notify({ 
          message: 'Successfully compiled LESS',
          emitError: true
          })
    );
    //.pipe( livereload() );

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
  // livereload.listen(); 
  gulp.watch('./assets/less/*.less', ['less']);
  gulp.watch(['./assets/less/_bootstrap.less', './assets/less/_bootstrap_variables.less'], ['bootstrap']);
  gulp.watch(['*', 'inc/*', 'parts/*'], function(data){
    gulp.src(data.path)
      .pipe( livereload() );
  });

});

gulp.task('dist', ['bootstrap'], function () {

  // Css
  return gulp.src(['./assets/less/main.less'])
    .pipe( sourcemaps.init() )
    .pipe( less() )
    .pipe( autoprefixer({
     browsers: ['last 2 versions'],
     cascade: false
    }) )
    .pipe( sourcemaps.write('./assets/css') )
    .pipe( gulp.dest( './assets/css' ) );

});

/*==========  Utilities  ==========*/
function consoleError(error){
  console.log(error);
  // this.emmit('end')
}