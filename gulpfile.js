'use strict';
 
const gulp = require('gulp');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const cleanCSS = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('autoprefixer');
const rename = require("gulp-rename");
// const mqpacker = require('css-mqpacker');

// Error handling
let sassOptions = {
  errLogToConsole: true,
  outputStyle: 'expanded'
};

let autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};


gulp.task('sass', function () {
  return gulp.src('assets/sass/**/*.scss')

    .pipe(sourcemaps.init())
    
    .pipe(sass(sassOptions).on('error', sass.logError))

    .pipe(postcss([
      autoprefixer()
    ]))

    .pipe(sourcemaps.write())

    .pipe(gulp.dest('./'));
});


gulp.task('minify',() => {
  return gulp.src('style.css')
    .pipe(sourcemaps.init({loadMaps:true}))
    .pipe(cleanCSS({debug: true}, (details) => {
      console.log(`${details.name}: ${details.stats.originalSize}`);
      console.log(`${details.name}: ${details.stats.minifiedSize}`);
    }))
    .pipe(rename('style.min.css'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./'));
});

gulp.task('watch', function() {
  return gulp
    // Watch the input folder for change,
    // and run `sass` task when something happens
    .watch('assets/sass/**/*.scss', gulp.series('sass', 'minify'))
    // When there is a change,
    // log a message in the console
    .on('change', function(event) {
      console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
    });
});