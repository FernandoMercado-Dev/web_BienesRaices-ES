// Exportacion de plugins necesarios en postcss
module.exports = {
    plugins: [
        // importar autoprefixer
        require('gulp-autoprefixer'),
        // importar cssnano
        require('gulp-cssnano')({
            preset: 'default'
        })
    ]
}