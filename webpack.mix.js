const mix = require('laravel-mix')

mix.autoload({
    jquery: ['jQuery', '$', 'window.jQuery']
})

mix.browserSync({
    proxy: 'http://htmlwp.local/',
    files: [
        'admin/**/{*.php,*.css,*.js}',
        'public/**/{*.php,*.css,*.js}',
        'classes/**/*.php',
        'includes/**/*.php',
        '*.php',
        'template-parts/**/*.php'
    ]
})