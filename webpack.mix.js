const mix = require('laravel-mix');
require('laravel-mix-workbox');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
//FIXME:There is No 'C:\xampp\htdocs\Web_Invitation\resources\less\app.less' in 'C:\xampp\htdocs\Web_Invitation'
mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/date_selectbox.js', 'public/js')
    .js('resources/js/animation.js', 'public/js')
    .js('resources/js/getUsersInformation.js', 'public/js')
    .js('resources/js/qrCodeReader.js', 'public/js')
    .js('resources/js/addQuestion.js', 'public/js')
    .js('resources/js/duplicateCheckCeremonyId.js', 'public/js')
    .js('resources/js/popupImage.js', 'public/js')
    .js('resources/js/googleMapsApi.js', 'public/js')
    .js('resources/js/deletePhotosInAlbumPage.js', 'public/js')
    .js('resources/js/popup_confirmation.js', 'public/js')
    .sourceMaps()
    .autoload( {
        "jquery": [ '$', 'window.jQuery' ],
    })
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .postCss('resources/css/popupImage.css', 'public/css', [
        require('autoprefixer'),
    ])
    .postCss('resources/css/popupModal.css', 'public/css', [
        require('autoprefixer'),
    ]);
// mix
//     .less('resources/less/app.less', 'public/css')
//     .generateSW({
//         exclude: [
//             // キャッシュしないものを正規表現で指定
//             // exclude: [/\.(?:png|jpg|jpeg|svg)$/],
//         ],
//         //runtime rulesを定義
//         runtimeCaching: [{
//             // urlPattern: /\.(?:png|jpg|jpeg|svg)$/, URLを正規表現で表示
//         }],
//         handler: 'CacheFirst',
//         optione: {
//             //cacheName: '', カスタムしたキャッシュ名を使う
//             // キャッシュファイル数:10
//             expiration: {
//                 maxEntries: 10,
//             }
//         },
//         skipWiting: true,
//     });
mix
    .browserSync({
        proxy: {
            target: "http://127.0.0.1:8000",
        },
        files: [
            'resources/views/**/*.blade.php',
            "resources/**/*",
            "config/**/*",
            "routes/**/*",
            "app/**/*",
            "public/**/*"
        ],
        open: false,
        reloadOnRestart: true
    });
mix
    .webpackConfig({
        stats: {
            children: true,
        },
    });
