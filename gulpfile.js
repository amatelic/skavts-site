var elixir = require('laravel-elixir');
require('laravel-elixir-livereload');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  mix
    .browserify('gallerys.js')
    .browserify('users.js')
    .browserify('main/index.js')
    .browserify('article.js')
    .browserify('notification.js')
    .browserify('images.js')
    .browserify('images.js')
    .browserify('calender.js')
    // .sass('app.sass')
    .livereload();
});
