var webpack = require('webpack');


module.exports = {
    entry: "./js/chinese.js",
    output: {
        path: __dirname,
        filename: "bundle.js",
    },
    module: {
        loader: [
            { test: /\.css$/, loader: "style!css" },
            { test: /\.json$/, loader: "json" },
            { test: /\.scss$/, loader: 'style!css!sass?sourceMap' },
            { test: /\.(png|jpg)$/, loader: 'url-loader?limit=8192' }

        ]
    },

    plugins: [

    ]
};