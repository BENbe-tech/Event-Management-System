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
    .sass('resources/sass/home-event.scss','public/css/home-event.css')
    .sass('resources/sass/registered-events.scss','public/css/registered-events.css')
    .sass('resources/sass/registered-eventdetails.scss','public/css/registered-eventdetails.css')
    .js('resources/js/registered-eventdetails.js','public/js/registered-eventdetails.js')
    .sass('resources/sass/createsession.scss','public/css/createsession.css')
    .js('resources/js/createsession.js', 'public/js/createsession.js')
    .sass('resources/sass/session.scss','public/css/session.css')
    .sass('resources/sass/sessiondetails.scss','public/css/sessiondetails.css')
    .sass('resources/sass/comments.scss','public/css/comments.css')
    .sourceMaps();
