// Importación de dependencias como modulo de sistema ECMAScript modules

// SASS
import {src, dest, watch, series, parallel} from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);
import sourcemaps from 'gulp-sourcemaps';
import postcss from 'gulp-postcss';

// JS
import terser from 'gulp-terser-js';
import concat from 'gulp-concat';
import rename from 'gulp-rename';

// IMG
import imagemin from 'gulp-imagemin';
import cache from 'gulp-cache';
import notify from 'gulp-notify';
import webp from 'gulp-webp';

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    img: 'src/img/**/*'
}

// Compilar scss
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

// Compilar JS
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

// Optimizar imagenes
function optImagenes() {
    return src(paths.img)
    // Optimización
    .pipe(cache(
        imagemin({
            optimizationLevel: 3
        })
    ))
    // //////
    .pipe(dest('build/img'))
    // Notificación
    .pipe(notify('Imagen Completada'))
    // //////
}

// Convertir img a webp
function imgWebp() {
    return src(paths.img)
    // Conversión
    .pipe(webp())
    // //////
    .pipe(dest('build/img'))
    // Notificación
    .pipe(notify({ message: 'Imagen Completada Webp' }))
    // //////
}

// Watch
function watchFunciones() {
    watch(paths.scss, compilarSCSS)
    watch(paths.js, compilarJS)
    watch(paths.img, parallel(optImagenes, imgWebp))
}

export default series(compilarSCSS, compilarJS, optImagenes, imgWebp, watchFunciones);