// Importación de dependencias como modulo de sistema ECMAScript modules

// sass
import {src, dest, watch, series} from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);
import sourcemaps from 'gulp-sourcemaps';
import postcss from 'gulp-postcss';

const paths = {
    scss: 'src/scss/**/*.scss'
}

function compilarSCSS() {
    return src('src/scss/app.scss')
    // sourcemaps
    .pipe(sourcemaps.init())
        // Compilar
        .pipe(sass({
            silenceDeprecations: ['legacy-js-api']
        })
        .on('error', sass.logError))
        // //////
        // Postcss
        .pipe(postcss())
        // //////
    .pipe(sourcemaps.write('.'))
    // //////
    .pipe(dest('build/css'))
}