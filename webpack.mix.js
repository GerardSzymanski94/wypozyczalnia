const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setPublicPath('public_html/');

mix.copyDirectory('resources/fonts', 'public_html/fonts');

mix.js('resources/js/main.js', 'js').sourceMaps()
    .sass('resources/sass/app.scss', 'css');