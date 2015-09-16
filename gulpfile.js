var less = require('gulp-less'),
    path = require('path'),
    gulp = require('gulp'),
    LessPluginCleanCSS = require('less-plugin-clean-css'),
    cleancss = new LessPluginCleanCSS({ advanced: true }),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps = require('gulp-sourcemaps'),
    livereload = require('gulp-livereload'),
    notify = require('gulp-notify');
//    browserSync = require('browser-sync');


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

 //   browserSync({
 //       proxy: "http://tricot.dev/"
 // })
  
 // gulp.watch("./*").on('change', browserSync.reload);

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