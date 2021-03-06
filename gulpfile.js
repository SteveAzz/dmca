var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');

    mix.scripts([
        'pubsub.js',
        'ajax-helpers.js',
        'app.js'
    ], null, 'public/js');

    mix.styles([
        'bootstrap/dist/css/bootstrap.css',
        'app.css'
    ], null, 'public/css')
});
