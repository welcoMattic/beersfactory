const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableVersioning(Encore.isProduction())
    .enableSourceMaps(!Encore.isProduction())
    .addStyleEntry('css/app', './assets/css/app.scss')
    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: false,
    })
;

module.exports = Encore.getWebpackConfig();
