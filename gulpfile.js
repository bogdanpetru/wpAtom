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

// ## Config
var assetsPaths = {
  sass:{
    bootstrapSCSS: './node_modules/bootstrap-sass/assets/stylesheets/',
    src: './src/sass/'
  }
};


gulp.task('setup', ['moveBootstrapVariables', 'importBootstrap'], function(){
  // copy _bootstrap.scss and make path corrections
});

gulp.task('sass', function () {
  // assetsPaths

  // return gulp.src(['./assets/less/main.less'])
  //   .pipe(sourcemaps.init())
  //   .pipe( sass().on('error', notifyError) )
  //   .pipe( sourcemaps.write('./') )
  //   .pipe( gulp.dest( './assets/css/' ) )
  //   .pipe( notify({ message: 'SASS Done', emitError: true })
  //   );
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


gulp.task('moveBootstrapVariables', function(){
  var varPath = assetsPaths.sass.bootstrapSCSS  + 'bootstrap/_variables.scss';
  var newVarPath = assetsPaths.sass.src + '/_bootstrap_variables.scss';

  fs.createReadStream(varPath).pipe(
    fs.createWriteStream(newVarPath)
  );
});

gulp.task('importBootstrap', function(){
  // copy _variables.scss from bootstrap-sass
  var bootstrapPath = assetsPaths.sass.bootstrapSCSS  + '_bootstrap.scss';
  var newBootstrapPath = assetsPaths.sass.src + '_bootstrap.scss';

  var newBootstrapPathReadStream = fs.createReadStream(bootstrapPath);
  var newBootstrapPathWriteStream = fs.createWriteStream(newBootstrapPath);

  newBootstrapPathReadStream
  .pipe(
    concatStream(function(fileBuffer){
      var fileText = fileBuffer.toString();
      var newText;

      newText = fileText.replace(
        /bootstrap/ig,
        assetsPaths.sass.bootstrapSCSS  + 'bootstrap'
      );

      newBootstrapPathWriteStream.write(newText);
      newBootstrapPathWriteStream.close();
    })
  );
});