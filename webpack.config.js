const path = require('path');
const { VueLoaderPlugin } = require('vue-loader')
const webpack = require('webpack')
var resolveRoot = path.join(__dirname, 'node_modules');

module.exports = {
  entry: './resources/src/main.js',
  output: {
    path: path.resolve('./assets/js'),
    filename: 'ouvidoria.bundle.js'
  },

  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader',
        options: {
          loaders: {
          }
          // other vue-loader options go here
        }
      },
      {
        test: /\.(png|jpg|gif)$/, 
        loader: 'file-loader',
        options: {
          name: '[name].[ext]',
          outputPath: '../img/compiled/',    // where the fonts will go
          publicPath: './assets/img/compiled/'       // override the default path
        }
      },
      {
        test: /\.(svg|ttf|eot|woff|woff2)$/, 
        loader: 'file-loader',
        options: {
          name: '[name].[ext]',
          outputPath: '../fonts/',    // where the fonts will go
          publicPath: './assets/fonts/'       // override the default path
        }
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: "eslint-loader",
        options: {
          formatter: require("eslint/lib/formatters/stylish"),
          formatter: require("eslint-friendly-formatter"),
          formatter: function(results) {
            return JSON.stringify(results, null, 2);
          }
        }
      },
      
      {
        test: /\.(sa|sc|c)ss$/,
        use: ['style-loader', 'css-loader', 'sass-loader']
      }
    ]
  },
  resolve: {
    alias: {
      vue: 'vue/dist/vue.js'
    }
  },
  plugins: [
    // make sure to include the plugin for the magic
    new VueLoaderPlugin(),
    new webpack.LoaderOptionsPlugin({ options: {} }),
  ]
};