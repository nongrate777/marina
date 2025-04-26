let mix = require('laravel-mix');

mix.copyDirectory('sources/images', 'assets/images');
mix.copyDirectory('sources/fonts',  'assets/fonts');

mix.js('sources/js/scripts.js', 'assets/js').sass('sources/styles/styles.scss', 'assets/styles').sass('sources/styles/admin.scss', 'assets/styles').options({
    processCssUrls: false,
    postCss: [
        require('autoprefixer')({
            overrideBrowserslist: ['last 20 versions']
        })
    ]
});

mix.sourceMaps(false, 'source-map');

mix.minify([ 'assets/js/scripts.js', 'assets/styles/styles.css', 'assets/styles/admin.css']);


