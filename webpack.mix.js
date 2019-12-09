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

mix.styles([
    'resources/assets/main/frontend/css/style.css'
], 'public/css/style.min.css')
    .version(['public/css/']);

mix.babel([
    'resources/assets/main/frontend/js/libs.min.js',
    'resources/assets/main/frontend/js/script.js',
], 'public/js/app.min.js');

mix.react([
    'resources/assets/main/frontend/js/content/syns.js',
    'resources/assets/main/frontend/js/content/cards.js',
    'resources/assets/main/frontend/js/content/text.js',
    'resources/assets/main/frontend/js/main.js',
], 'public/js/demo.min.js');


mix.copy('resources/assets/main/frontend/js/libs/fancybox/fancybox_overlay.png', 'public/css/fancybox_overlay.png');
mix.copy('resources/assets/main/frontend/js/libs/fancybox/fancybox_overlay.png', 'public/css/fancybox_sprite.png');

mix.version(['public/js/']);