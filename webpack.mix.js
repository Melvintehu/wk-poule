let mix = require('laravel-mix');

mix.sass('resources/assets/sass/xs/app.scss', 'public/flexbox/xs/')
    .sass('resources/assets/sass/sm/app.scss', 'public/flexbox/sm/')
    .sass('resources/assets/sass/md/app.scss', 'public/flexbox/md/')
    .sass('resources/assets/sass/lg/app.scss', 'public/flexbox/lg/')
    .sass('resources/assets/sass/CMS_CSS/app.scss', 'public/CMS_CSS/css')
    .js('resources/assets/js/app.js', 'public/js')
    .browserSync('wk-poule-helpman.local');