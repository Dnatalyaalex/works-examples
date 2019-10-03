//Подключение
const { src, dest, watch } = require('gulp'); 
const sass = require('gulp-sass');

function css() {
  return src('sass/**/*.scss')
    .pipe(sass({ outputStyle: "compressed" }))
    .pipe(dest('css'))
}

function style() {
  return src('sass/**/*.scss')
    .pipe(sass({ outputStyle: "expanded" }))
    .pipe(dest('style'))
}

watch("sass/**/*.scss", css);

exports.css = css;
exports.default = css;