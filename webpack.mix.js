let mix = require('laravel-mix');

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

mix.disableSuccessNotifications();

mix.js('resources/assets/js/script.js', 'public/js')
   .js('resources/assets/js/ingredients.js', 'public/js')
   .js('resources/assets/js/cake.js', 'public/js')
   .sass('resources/assets/sass/style.sass', 'public/css');

mix.browserSync(
    {
        proxy: "sweet-shop",
        notify: false,
        ui: false
    }
)