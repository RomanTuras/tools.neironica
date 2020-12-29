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

mix.js([
    'resources/js/app.js',
    'resources/js/helpers/SudokuHelper.js',
    'resources/js/txt-tools/sudokuGenerator.js',
    'resources/js/txt-tools/shulteTable.js',
    'resources/js/txt-tools/shulteGorbovaTable.js',
    'resources/js/txt-tools/textConverter.js'
], 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
