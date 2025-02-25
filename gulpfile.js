// Importación de dependencias como modulo de sistema ECMAScript modules

// SASS
const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');

// JS
const terser = require('gulp-terser-js');
const concat = require('gulp-concat');
const rename = require('gulp-rename');

// IMG
const imagemin = require('gulp-imagemin');
const cache = require('gulp-cache');
const notify = require('gulp-notify');
const webp = require('gulp-webp');

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
        .pipe(postcss([
            autoprefixer(),
            cssnano()
        ]))
        // //////
    .pipe(sourcemaps.write('.'))
    // //////
    .pipe(dest('public/build/css'))
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
    .pipe(dest('public/build/js'))
}

// Optimizar imagenes
async function optImagenes() {
    const imagemin = (await import('gulp-imagemin')).default;

    return src(paths.img)
    // Optimización
    .pipe(cache(
        imagemin({
            optimizationLevel: 3
        })
    ))
    // //////
    .pipe(dest('public/build/img'))
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
    .pipe(dest('public/build/img'))
    // Notificación
    .pipe(notify({ message: 'Imagen Completada Webp' }))
    // //////
}

// Watch
function watchFunciones() {
    watch(paths.scss, compilarSCSS)
    watch(paths.js, compilarJS)
    watch(paths.img, optImagenes)
    watch(paths.img, imgWebp)
}

exports.compilarSCSS = compilarSCSS;
exports.watchFunciones = watchFunciones;
exports.default = parallel(compilarSCSS, compilarJS, optImagenes, imgWebp, watchFunciones);