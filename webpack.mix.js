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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'node_modules/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/gentelella/vendors/font-awesome/css/font-awesome.css',
    'node_modules/gentelella/vendors/nprogress/nprogress.css',
    'node_modules/gentelella/vendors/iCheck/skins/flat/green.css',
    'node_modules/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
    'node_modules/gentelella/vendors/jqvmap/dist/jqvmap.min.css',
    'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css',
    'node_modules/gentelella/build/css/custom.min.css',
], 'public/assets/css/styles.css')
.version();

mix.copyDirectory('resources/assets/vendors/font-awesome/fonts', 'public/assets/fonts')
	.copyDirectory('resources/assets/vendors/bootstrap/dist/fonts', 'public/assets/fonts')
    .version();

mix.copy(['resources/assets/vendors/iCheck/skins/flat/grey.png',
		'resources/assets/vendors/iCheck/skins/flat/grey@2x.png',
		'resources/assets/vendors/iCheck/skins/flat/green.png',
		'resources/assets/vendors/iCheck/skins/flat/green@2x.png'
    ], 
        'public/assets/css/')
    .version();

mix.scripts([
        'node_modules/gentelella/vendors/jquery/dist/jquery.min.js',
        'node_modules/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js',
        'node_modules/gentelella/vendors/fastclick/lib/fastclick.js',
        'node_modules/gentelella/vendors/nprogress/nprogress.js',
        'node_modules/gentelella/vendors/Chart.js/dist/Chart.min.js',
        'node_modules/gentelella/vendors/gauge.js/dist/gauge.min.js',
        'node_modules/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
        'node_modules/gentelella/vendors/iCheck/icheck.min.js',
        'node_modules/gentelella/vendors/skycons/skycons.js',
        'node_modules/gentelella/vendors/Flot/jquery.flot.js',
        'node_modules/gentelella/vendors/Flot/jquery.flot.pie.js',
        'node_modules/gentelella/vendors/Flot/jquery.flot.time.js',
        'node_modules/gentelella/vendors/Flot/jquery.flot.stack.js',
        'node_modules/gentelella/vendors/Flot/jquery.flot.resize.js',
        'node_modules/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js',
        'node_modules/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js',
        'node_modules/gentelella/vendors/flot.curvedlines/curvedLines.js',
        'node_modules/gentelella/vendors/DateJS/build/date.js',
        'node_modules/gentelella/vendors/moment/min/moment.min.js',
        'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js',
        'node_modules/gentelella/build/js/custom.min.js',
    ], 'public/assets/js/app.js').version();