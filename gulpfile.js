var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var livereload = require('gulp-livereload');
var notify = require('gulp-notify');
var sass = require('gulp-sass');
var gutil = require('gulp-util');
var path = require('path');
var webpackConfig = require("./webpack.config.js");
var fs = require('fs');
var concatStream = require('concat-stream');

var webpack = require("webpack");
var WebpackDevServer = require("webpack-dev-server");


/**
 * TODO
 * - add dist task
 * - img compression
 * - minify + uglify css and js
 */

// ## Config
var assets = {
  css:{
    src: './src/sass/',
    dist: './dist/css/',
    vendor: {
      bootstrapSrc : './node_modules/bootstrap-sass/assets/stylesheets/'
    },
  }
};

var config = {
  sass: {
    outputStyle: 'expanded'
  }
}


gulp.task('setup', ['moveBootstrapVariables', 'importBootstrap'], function(){
  // copy _bootstrap.scss and make path corrections
});

gulp.task('sass', function () {
  return gulp.src( './src/sass/main.scss' )
    .pipe( sass(config.sass).on('error', sass.logError ) )
    .pipe( sourcemaps.init() )
    .pipe( autoprefixer() )
    .pipe( sourcemaps.write( assets.css.dist ) )
    .pipe( gulp.dest('./') ) 
    .pipe( livereload() )
    .pipe( notify({ message: 'SASS Done', emitError: true }));
});

gulp.task('bootstrap', function(){
  return gulp.src( assets.css.src + 'bootstrap.scss' )
    .pipe( sass(config.sass) )
    .pipe( gulp.dest( assets.css.dist ) )
    .pipe( notify({ message: 'Bootstrap Done', emitError: true }));
});

gulp.task('webpack', function(callback){
  var myConfig = Object.create(webpackConfig);
 
  webpack(myConfig, 
      function(err, stats) {
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

gulp.task('dev', ['bootstrap', 'sass', 'webpack'], function(){
  livereload.listen();
  // gulp.watch( assets.css.src + '/**/*.scss')
  // .on('change', )
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


gulp.task('moveBootstrapVariables', function(){
  var varPath = assets.css.vendor.bootstrapSrc  + 'bootstrap/_variables.scss';
  var newVarPath = assets.css.src + '/common/_bootstrap_variables.scss';

  fs.createReadStream(varPath).pipe(
    fs.createWriteStream(newVarPath)
  );
});

gulp.task('importBootstrap', function(){
  // copy _variables.scss from bootstrap-sass
  var bootstrapPath = assets.css.vendor.bootstrapSrc + '_bootstrap.scss';
  var newBootstrapPath = assets.css.src + 'bootstrap.scss';

  var newBootstrapPathReadStream = fs.createReadStream(bootstrapPath);
  var newBootstrapPathWriteStream = fs.createWriteStream(newBootstrapPath);

  newBootstrapPathReadStream
  .pipe(
    concatStream(function(fileBuffer){
      var fileText = fileBuffer.toString();
      var newText;

      newText = fileText.replace(
        /bootstrap/ig,
        assets.css.vendor.bootstrapSrc  + 'bootstrap'
      );

      newBootstrapPathWriteStream.write(newText);
      newBootstrapPathWriteStream.close();
    })
  );
});
