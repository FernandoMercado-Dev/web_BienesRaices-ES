// Importación de dependencias como modulo de sistema ECMAScript modules

// SASS
import {src, dest, watch, series} from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);
import sourcemaps from 'gulp-sourcemaps';
import postcss from 'gulp-postcss';

// JS
import terser from 'gulp-terser-js';
import concat from 'gulp-concat';
import rename from 'gulp-rename';

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js'
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

function compilarJS() {
    return src(paths.js)
    // sourcemaps
    .pipe(sourcemaps.init())
        // Concatenar
        .pipe(concat('bundle.js'))
        // //////
        // Comprimir
        .pipe(terser({
            mangle: { toplevel: true }
        }))
        .on('error', function (error) {
            this.emit('end')
        })
        // //////
        // Renombrar
        .pipe(rename({
            suffix: '.min'
        }))
    .pipe(sourcemaps.write('.'))
    // //////
    .pipe(dest('build/js'))
}

// Watch
function watchFunciones() {
    watch(paths.scss, compilarSCSS)
    watch(paths.js, compilarJS)
}

export default series(compilarSCSS, compilarJS, watchFunciones);