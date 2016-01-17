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

 var paths = {
    'bootstrap': './vendor/bower_components/bootstrap-sass-official/assets/',
    'font-awesome': './vendor/bower_components/font-awesome-sass-official/assets/'
}


elixir(function(mix) {
    mix.sass('app.scss')
});


elixir(function(mix) {
    mix.scripts([
        'jquery-1.10.2.min.js',
	    'bootstrap.min.js',
	    'jquery.easing.min.js',
	    'classie.js',
	    'cbpAnimatedHeader.js',
		'jqBootstrapValidation.js',
		'contact_me.js',
		'freelancer.js'
    ]);
});
