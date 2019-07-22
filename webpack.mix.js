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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css');

mix.scripts([
    'node_modules/feather-icons/dist/feather.js',
    'node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min.js',
    'node_modules/bootstrap-select/js/bootstrap-select.js',
    'node_modules/bootstrap-select/js/i18n/defaults-en_US.js',
    'node_modules/swiper/dist/js/swiper.min.js',
    'node_modules/dropzone/dist/min/dropzone.min.js',

    'resources/js/vendors/function-admin.js',
], 'public/js/plugins-admin.js');


if (mix.config.inProduction) {
    mix.version();
}
