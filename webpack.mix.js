const mix = require('laravel-mix');
const glob = require('glob-all');  // 'glob-all' is already included
require('laravel-mix-purgecss');

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
   .sass('resources/sass/app.scss', 'public/css', {
       implementation: require('sass')
   })
   .purgeCss({
        enabled: mix.inProduction(),
        folders: ['resources', 'modules'],
        safelist: {
            standard: [/Layer_1/, /st1/],
            deep: [/dropdown/, /modal/],
        },
    })
   .options({
        processCssUrls: false 
    })
   .version()
   .webpackConfig({
     resolve: {
       modules: ['node_modules'],
     }
   });
