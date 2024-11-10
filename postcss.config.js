// Exportacion de plugins necesarios en postcss
module.exports = {
    plugins: [
        // importar autoprefixer
        require('autoprefixer'),
        // importar cssnano
        require('cssnano')({
            preset: 'default'
        })
    ]
}