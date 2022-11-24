const { src, dest, series, watch } = require('gulp');

// styles
const scss = require('gulp-sass')(require('sass'));
const autoPrefixer = require('gulp-autoprefixer');
const cssMinify = require('gulp-clean-css');
const rename = require('gulp-rename');

function styles() {
    return src('./public/src/main.scss')
        .pipe(scss())
        .pipe(autoPrefixer('last 2 versions'))
        .pipe(rename('Home.module.css'))
        .pipe(cssMinify())
        .pipe(dest('./public/assets/styles/'))
}


function watchTask() {
    watch(
            [
            './public/src/**/*.scss',
            ],
            series(styles)
        )
}

exports.default = series(styles, watchTask);