const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const sass = require('gulp-sass');

const sassTask = () => gulp.src("src/resources/src/scss/app.scss")
    .pipe(sass())
    .pipe(gulp.dest("src/resources/dist/css"))
    .pipe(browserSync.stream());


const watchTask = () => {

    browserSync.init({
        proxy: 'localhost:8080'
    });

    gulp.watch('src/resources/src/scss/**/*.scss', sassTask);

    gulp.watch(['views/**/*.php']).on('change', browserSync.reload);
};

gulp.task('default', watchTask);