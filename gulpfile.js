var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp task
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.scripts(
        [
            "/angular/**/*.js",
            //"/angular/app.js",
            //"/angular/controllers/chatcontroller.js"
        ],'public/angular/chat.js'
    ).version(['/angular/chat.js']);
    //mix.scripts(
    //    [
    //        "/bower_components/**/*.js"
    //        //"/bower_components/angular/angular.js",
    //        //"/bower_components/angular/angular.min.js",
    //        //"/bower_components/angular-route/angular-route.js",
    //        //"/bower_components/angular-route/angular-route.min.js"
    //
    //    ],'public/angular/bower_components.js'
    //).version(['/angular/chat.js','/angular/bower_components.js']);

    //mix.scripts(
    //    [
    //        __dirname('\node_modules\socket.io\lib\client.js'),
    //
    //    ],'public/socket/socket.js'
    //);
});
