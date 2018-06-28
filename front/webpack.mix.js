let mix = require('laravel-mix');
let ImageminPlugin = require('imagemin-webpack-plugin').default;
let CopyWebpackPlugin = require('copy-webpack-plugin');
let imageminMozjpeg = require('imagemin-mozjpeg');
let BrowserSyncPlugin = require('browser-sync-webpack-plugin');
var Webpack = require('webpack');
mix.pug = require('laravel-mix-pug');

mix.webpackConfig({
    plugins: [
        new CopyWebpackPlugin([{
            from: 'src/images',
            to: 'images'
            }, {
            from: 'src/fonts',
            to: 'fonts'
        }]),
        new ImageminPlugin({
            disable: process.env.NODE_ENV !== 'production',
            test: /\.(jpe?g|png|gif|svg)$/i,
            plugins: [
                imageminMozjpeg({
                    quality: 80,
                })
            ]
        }),
        new BrowserSyncPlugin({
            host: 'localhost',
            port: 3000,
            server: { baseDir: ['dist'] },
            files: ['src/pug/**/*.pug', 'src/sass/**/*.scss', 'src/js/**/*.js']
        }),
        new Webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        })
    ],
    module: {
        rules: [
            {
                test: /\.(pug|jade)$/,
                use: ['html-loader', 'pug-html-loader?pretty&exports=false']
            }
        ]
    }
});

mix.sass('src/sass/app.scss', 'dist/css')
   .js('src/js/app.js', 'dist/js')
   .pug('src/pug/*.pug', 'dist', {})
   .autoload({jquery: ['$', 'window.jQuery']})
   .setPublicPath('dist')
   .sourceMaps()
   .disableNotifications();