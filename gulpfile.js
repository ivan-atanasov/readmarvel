var elixir = require('laravel-elixir');

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

elixir(function (mix) {
    mix.sass([
            'frontend/app.scss'
        ], 'public/assets/css')
        .scripts([
            'frontend/bootstrap.js',
            'frontend/characters.js',
            'frontend/datetimepicker.js',
            'frontend/lists.js',
            'frontend/parsley.js',
            'frontend/profile.js'
        ], 'public/assets/js');

    mix.version([
        'public/assets/css/app.css',
        'public/assets/js/all.js'
    ]);
});
