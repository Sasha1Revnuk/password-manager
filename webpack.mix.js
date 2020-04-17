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

mix.js('resources/js/index', 'public/acc/js').version()
mix.js('resources/js/webs', 'public/acc/js').version()
mix.js('resources/js/addPassword', 'public/acc/js').version()
mix.js('resources/js/editPassword', 'public/acc/js').version()
mix.js('resources/js/groups', 'public/acc/js').version()
mix.js('resources/js/quicks', 'public/acc/js').version()
mix.js('resources/js/marks', 'public/acc/js').version()
mix.js('resources/js/notes', 'public/acc/js').version()
mix.js('resources/js/notesEdit', 'public/acc/js').version()
