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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/create.js', 'public/js/create.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/create.scss','public/css/create.css')
    .sass('resources/sass/organizer.scss','public/css/organizer.css')
    .sass('resources/sass/myevents.scss','public/css/myevents.css')
    .sass('resources/sass/myeventdetails.scss','public/css/myeventdetails.css')
    .sass('resources/sass/home.scss','public/css/home.css')
    .sourceMaps();
