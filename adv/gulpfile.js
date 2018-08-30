var gulp = require("gulp");
var rigger = require("gulp-rigger");

gulp.task("rigger", function() {
  gulp
    .src("./*.html")
    .pipe(rigger())
    .pipe(gulp.dest("./"));
});

var LessAutoprefix = require("less-plugin-autoprefix");
var autoprefix = new LessAutoprefix({
  grid: true,
  browsers: ["ie >= 11", "last 2 versions"]
});
var LessPluginCleanCSS = require("less-plugin-clean-css");
var cleanCSSPlugin = new LessPluginCleanCSS({ advanced: true });
var less = require("gulp-less");

gulp.task("less", function() {
  return gulp
    .src("./less/*.less")
    .pipe(
      less({
        // plugins: [autoprefix, cleanCSSPlugin]
        plugins: [autoprefix]
      })
    )
    .pipe(gulp.dest("./css"));
});

var browserSync = require("browser-sync").create();
gulp.task("browserSync", function() {
  browserSync.init({
    server: {
      baseDir: "./"
    }
  });
});

gulp.task("watch", ["browserSync", "less"], function() {
  gulp.watch("./less/*", ["less"]);
  gulp.watch("./include/*.html", ["rigger"]);
  gulp.watch("./css/*.css", browserSync.reload);
  gulp.watch("./*.html", browserSync.reload);
  gulp.watch("./js/**/*.js", browserSync.reload);
});

// ***********************Min CSS************************
var gulp = require('gulp');
var cssmin = require('gulp-cssmin');
// var rename = require('gulp-rename');

gulp.task('minCss', function () {
    gulp.src('./css/*.css')
        .pipe(cssmin())
        // .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../dist/css'));
});

// ***********************Min JS************************
var minify = require('gulp-minify');

gulp.task('minJs', function() {
  gulp.src('./js/*.js')
  .pipe(minify({
    ext:{
      src:'-debug.js',
      min:'.js'
    }
}))
    .pipe(gulp.dest('../dist/js'))
});

// *******************Compres images*****************************
var imagemin = require('gulp-imagemin');

gulp.task('compressImg', function() {
    gulp.src('img/**/*')
        .pipe(imagemin())
        .pipe(gulp.dest('../dist/img'))
});

gulp.task('move:images', function(){
  return gulp.src('./img/**/*')
  .pipe(gulp.dest('../dist/img'));
});

gulp.task('move:fonts', function() {
  return gulp.src('./fonts/**/*')
  .pipe(gulp.dest('../dist/fonts'))
})

gulp.task('move:html', function() {
  return gulp.src('./*.html')
  .pipe(gulp.dest('../dist/'))
})

// gulp.task('move:css', function() {
//   return gulp.src('./css/**/*')
//   .pipe(gulp.dest('../dist/css'))
// })

// gulp.task('move:js', function() {
//   return gulp.src('./js/**/*')
//   .pipe(gulp.dest('../dist/js'))
// })

gulp.task('build', [`compressImg`, `move:fonts`, 'move:html', 'minCss', 'minJs'], function (){
  console.log('Building files');
})
