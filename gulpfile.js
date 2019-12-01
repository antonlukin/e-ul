const gulp = require('gulp');
const sass = require('gulp-sass');
const sassGlob = require('gulp-sass-glob');
const concat = require('gulp-concat');
const cleanCss = require('gulp-clean-css');
const prefix = require('gulp-autoprefixer');
const plumber = require('gulp-plumber');
const uglify = require('gulp-uglify-es').default;
const sassvg = require('gulp-sassvg');


gulp.task('vendor:swiper', (done) => {
  gulp.src('node_modules/swiper/css/swiper.min.css')
    .pipe(gulp.dest('app/assets/vendor'));

  gulp.src('node_modules/swiper/js/swiper.min.js')
    .pipe(gulp.dest('app/assets/vendor'));

  done();
});


gulp.task('front:styles', (done) => {
  gulp.src('src/styles/app.scss')
    .pipe(plumber())
    .pipe(sassGlob())
    .pipe(sass({
      errLogToConsole: true
    }))
    .pipe(prefix())
    .pipe(concat('styles.min.css'))
    .pipe(cleanCss({
      compatibility: 'ie9'
    }))
    .pipe(gulp.dest('app/assets'));

  done();
});


gulp.task('front:scripts', (done) => {
  gulp.src('src/scripts/*.js')
    .pipe(plumber())
    .pipe(uglify())
    .pipe(concat('scripts.min.js'))
    .pipe(gulp.dest('app/assets'))

  done();
});


gulp.task('front:images', (done) => {
  gulp.src('src/images/*.{png,jph}')
    .pipe(gulp.dest('app/assets/images/'));

  done();
});


gulp.task('front:fonts', (done) => {
  gulp.src('src/fonts/**/*.{woff,woff2}')
    .pipe(gulp.dest('app/assets/fonts/'));

  done();
});


gulp.task('admin:scripts', (done) => {
  gulp.src('src/admin/*.js')
    .pipe(plumber())
    .pipe(uglify())
    .pipe(gulp.dest('app/assets/admin'))

  done();
});

gulp.task('admin:styles', (done) => {
  gulp.src('src/admin/*.scss')
    .pipe(plumber())
    .pipe(sassGlob())
    .pipe(sass({
      errLogToConsole: true
    }))
    .pipe(prefix())
    .pipe(gulp.dest('app/assets/admin'));

  done();
});


gulp.task('vendor:sassvg', (done) => {
  gulp.src('src/images/svg/*.svg')
    .pipe(sassvg({
      outputFolder: 'src/styles/sassvg/'
    }));

  done();
});


/**
 * frontend development task
 */
gulp.task('watch:front', (done) => {
  gulp.watch('src/**/*', gulp.series('front:styles', 'front:scripts'));

  done();
});


/**
 * admin styles and scripts
 */
gulp.task('watch:admin', (done) => {
  gulp.watch('src/admin/**/*', gulp.series('admin:styles', 'admin:scripts'));

  done();
});


gulp.task('default', gulp.series(
  'front:styles', 'front:scripts', 'front:images', 'front:fonts', 'admin:styles', 'admin:scripts', 'vendor:swiper'
));