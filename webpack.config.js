const path = require('path');

module.exports = {
    entry: ['./css/style.scss'],
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: 'app.js',
    },
    module: {
        rules: [
            { test: /\.s[ac]ss$/i, use: ['style-loader', 'css-loader', 'sass-loader'] },
            { test: /\.css$/, use: ['style-loader', 'css-loader'] },
        ],
    },
    devServer: {
        static: {
            directory: path.join(__dirname, ''),
        },
    }
};