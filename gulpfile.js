var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var livereload = require('gulp-livereload');
var notify = require('gulp-notify');
var sass = require('gulp-sass');
var gutil = require('gulp-util');
var path = require('path');
var webpackConfig = require("./webpack.config.js");

var webpack = require("webpack");
var WebpackDevServer = require("webpack-dev-server");

// ## Config

gulp.task('less', function () {
  return gulp.src(['./assets/less/main.less'])
    .pipe(sourcemaps.init())
    .pipe( sass().on('error', notifyError) )
    .pipe( sourcemaps.write('./') )
    .pipe( gulp.dest( './assets/css/' ) )
    .pipe( notify({ message: 'SASS Done', emitError: true })
    );
});

gulp.task('bootstrap', function(){
  return gulp.src(['./assets/less/_bootstrap.less'])
    .pipe(less({
      plugins: [cleancss],
    }))
    .pipe( gulp.dest( './assets/css' ) );
});

gulp.task('webpack', function(callback){
  var myConfig = Object.create(webpackConfig);
 
  webpack(myConfig, function(err, stats) {
      if(err) throw new gutil.PluginError("webpack", err);
      gutil.log("[webpack]", stats.toString({
          // output options
      }));
      callback();
  });
  
});

// ### Webpack goodness
gulp.task("webpack-dev-server", function(callback) {
    // Start a webpack-dev-server
    var compiler = webpack({
        // configuration
    });

    new WebpackDevServer(compiler, {
        // server and middleware options
    }).listen(8080, "localhost", function(err) {
        if(err) throw new gutil.PluginError("webpack-dev-server", err);
        // Server listening
        gutil.log("[webpack-dev-server]", "http://localhost:8080/webpack-dev-server/index.html");

        // keep the server alive or continue?
        // callback();
    });
});

// ### Images
gulp.task('images', function() {
  return gulp.src(globs.images)
    .pipe(imagemin({
      progressive: true,
      interlaced: true,
      svgoPlugins: [{removeUnknownsAndDefaults: false}, {cleanupIDs: false}]
    }))
    .pipe(gulp.dest(path.dist + 'images'))
    .pipe(browserSync.stream());
});

gulp.task('dev', function(){
});

gulp.task('dist', ['bootstrap'], function () {
  /**
   * Todo
   * - move files to dist
   * - clean up
   */
});

/*==========  Utilities  ==========*/
function log(x){
  console.log(x);
  return x;
}

function notifyError (error) {
  return "Message to the notifier: " + error.message;
  sass.logError();
}