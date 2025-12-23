const mix = require('laravel-mix');

// Setup Vue
mix.js('resources/js/app.js', 'public/assets/js')
    .vue({ version: 3 })
    .postcss('resources/css/app.css', 'public/assets/css', []);

// Compiling Custom CSS
mix.styles([
    'public/front-assets/assets/css/bootstrap.css',
    'public/front-assets/assets/css/animate.css',
    'public/front-assets/assets/css/swiper-bundle.css',
    'public/front-assets/assets/css/slick.css',
    'public/front-assets/assets/css/magnific-popup.css',
    'public/front-assets/assets/css/font-awesome-pro.css',
    'public/front-assets/assets/css/flaticon_shofy.css',
    'public/front-assets/assets/css/spacing.css',
    'public/front-assets/assets/css/main.css',
], 'public/front-assets/assets/css/all.css');

// Compiling Custom JavaScript
mix.scripts([
    'public/front-assets/assets/js/vendor/jquery.js',
    'public/front-assets/assets/js/swiper-bundle.js',
    'public/front-assets/assets/js/vendor/jquery.js',
'public/front-assets/assets/js/vendor/waypoints.js',
'public/front-assets/assets/js/bootstrap-bundle.js',
'public/front-assets/assets/js/meanmenu.js',
'public/front-assets/assets/js/slick.js',
'public/front-assets/assets/js/range-slider.js',
'public/front-assets/assets/js/magnific-popup.js',
'public/front-assets/assets/js/nice-select.js',
'public/front-assets/assets/js/purecounter.js',
'public/front-assets/assets/js/countdown.js',
'public/front-assets/assets/js/wow.js',
'public/front-assets/assets/js/isotope-pkgd.js',
'public/front-assets/assets/js/imagesloaded-pkgd.js',
'public/front-assets/assets/js/ajax-form.js',
'public/front-assets/assets/js/main.js',
    // You can add other JS files here if necessary
], 'public/front-assets/assets/js/all.js');

// Versioning files for cache busting
mix.version();
