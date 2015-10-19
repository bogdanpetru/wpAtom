var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var notify = require('gulp-notify');
var sass = require('gulp-sass');
var gutil = require('gulp-util');
var path = require('path');
var fs = require('fs');
var concatStream = require('concat-stream');

var browserSync = require('browser-sync').create();
var bs;

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
  },
  js:{
    dist: './dist/js/'
  },
  img{
    src: './src/img/'
    dist: './dist/img/'
  }
};

var config = {
  sass: {
    outputStyle: 'expanded'
  },

  browserSync: {
    proxy: "http://wp.dev/",
  }
}

gulp.task('setup', ['moveBootstrapVariables', 'importBootstrap'], function(){
  // copy _bootstrap.scss and make path corrections
});

gulp.task('browserSync', function(){
    browserSync.init(
      config.browserSync
    );
})

gulp.task('sass', function () {
  return gulp.src( './src/sass/main.scss' )
    .pipe( sass(config.sass).on('error', sass.logError ) )
    .pipe( sourcemaps.init() )
    .pipe( autoprefixer() )
    .pipe( sourcemaps.write( assets.css.dist ) )
    .pipe( gulp.dest( assets.css.dist ) ) 
    .pipe( browserSync.stream() )
    .pipe( notify({ message: 'SASS Done', emitError: true }));
;});

gulp.task('bootstrap', function(){
  return gulp.src( assets.css.src + 'bootstrap.scss' )
    .pipe( sass(config.sass) )
    .pipe( gulp.dest( assets.css.dist ) )
    .pipe( notify({ message: 'Bootstrap Done', emitError: true }));
});


// ### Images
gulp.task('images', function() {
  return gulp.src(assets.img.src)
    .pipe(imagemin({
      progressive: true,
      interlaced: true,
      svgoPlugins: [{removeUnknownsAndDefaults: false}, {cleanupIDs: false}]
    }))
    .pipe(gulp.dest(assets.img.dest))
    .pipe(browserSync.stream());
});

gulp.task('dev', ['browserSync', 'bootstrap', 'sass'], function(){

  gulp.watch( assets.css.src + '**/**', ['sass']);
  gulp.watch( [assets.js.dist + '**'], browserSync.reload);
  gulp.watch( ['./**.php', './inc/**.php', './parts/**.php', './content/**.php'], browserSync.reload);
});

gulp.task('dist', ['scss', 'images', 'bootstrap'], function () {
  /**
   * Todo
   * - move files to dist
   * - clean up
   */
  gulp.src([
      './content',
      './inc',
      './dist',
      './parts',
      './vendor',
      './*.php',
      './readme.md',
      './*.css',
    ])
    .pipe(gulp.dest('../wpAppDist/'));
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
