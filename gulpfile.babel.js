import gulp from 'gulp';
import concat from 'gulp-concat';
import babel from 'gulp-babel';

gulp.task('bs-reload', () => {
  browserSync.reload();
});

//concat lib
gulp.task('concat:libs', ()=>{
  gulp.src([
    './bower_components/angular/angular.min.js',
    './bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js',
    './bower_components/json-formatter/dist/json-formatter.min.js'
  ])
  .pipe(concat('libs.js'))
  .pipe(gulp.dest('./'))
});

//compile and concat files
gulp.task('concat', () => {
  gulp.src([
    './src/*.js',
    './src/!(bower_components)/**/*.js',
    '!./src/**/*_test.js',
    '!./bundle.js'
  ])
    .pipe(babel({
      presets: ['es2015']
    }))
    .pipe(concat('bundle.js'))
    .pipe(gulp.dest('./'))
});