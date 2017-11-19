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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/home.js', 'public/js')
   .sass('resources/assets/sass/home.scss', 'public/css');
   
mix.js('resources/assets/js/widget.js', 'public/js')
    .js('resources/assets/js/chat-pc.js', 'public/js/chat/pc.js')
    .js('resources/assets/js/chat-mobile.js', 'public/js/chat/mobile.js')
    
//if (mix.inProduction) {
//    mix.version();
//}

mix.copyDirectory('resources/assets/img', 'public/img');