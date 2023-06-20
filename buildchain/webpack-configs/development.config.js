// production.config.js
// returns a webpack config object for production builds

// node modules
const path = require('path');

// webpack plugins
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

// return a webpack config
module.exports = (type = 'modern', settings) => {
  // common config
  const common = () => ({
    mode: 'development',
    output: {
      path: path.resolve(__dirname, settings.paths.dist),
      publicPath: settings.urls.publicPath()
    },
    resolve: {
      modules: [
        path.resolve(__dirname, '../node_modules'),
      ],
    },
  });
  // configs
  const configs = {
    // development config
    development: {
      // legacy development config
      legacy: {
        ...common(),
        optimization: {
          minimize: false,
          runtimeChunk: {
            name: 'runtime'
          },
          splitChunks: {
            chunks: 'all',
            name: 'commons',
            cacheGroups: {
              vendors: {
                test: /[\\/]node_modules[\\/]/,
                name: 'vendors',
                chunks: 'all'
              },
              styles: {
                chunks: 'all',
                enforce: true,
                name: settings.cssName,
                test: /\.(pcss|css|vue)$/,
                type: 'css/mini-extract',
              }
            }
          },
        },
        output: {
          filename: path.join('./js', '[name].js'),
        },
        plugins: [
          new MiniCssExtractPlugin({
            filename: path.join('./css', '[name].css'),
          }),
        ],
      },
      // legacy production config
      modern: {
        ...common(),
        optimization: {
          minimize: false,
          runtimeChunk: {
            name: 'runtime'
          },
        },
        output: {
          filename: path.join('./js', '[name].js'),
        },
      },
    },
    // production config
    production: {
      // legacy development config
      legacy: {},
      // modern development config
      modern: {
        ...common(),
      },
    }
  };

  return configs[process.env.NODE_ENV][type];
}
