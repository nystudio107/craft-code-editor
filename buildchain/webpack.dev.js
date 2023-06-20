// webpack.prod.js
// development build config

// environment
process.env.NODE_ENV = process.env.NODE_ENV || 'development';

// webpack config file helpers
const {buildWebpackConfigs, legacyWebpackConfigs, modernWebpackConfigs} = require('get-webpack-config');

// production multi-compiler module exports
module.exports = [
  legacyWebpackConfigs(
    'app',
    'development',
    'manifest',
    'babel-loader',
    'image-loader',
    'font-loader',
    'monaco-editor',
    'postcss-loader',
    'typescript-loader',
  ),
];
