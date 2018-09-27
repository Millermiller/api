var path = require('path')
var utils = require('./utils')
var config = require('../config')
var vueLoaderConfig = require('./vue-loader.conf')

function resolve(dir) {
    return path.join(__dirname, '..', dir)
}

module.exports = {
    entry: {
        app: './resources/assets/main/backend/client/index.js'
    },
    output: {
        path: path.resolve('public/main/backend'),
        filename: '[name].js',
        publicPath: '/main/backend/'
    },
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            'vue$': 'vue/dist/vue.esm.js',
            '@': resolve('docs'),
            '@components': resolve('src/components'),
            '@utils': resolve('src/utils'),
            views: path.resolve(__dirname, '../client/views'),
            assets: path.resolve(__dirname, '../client/assets'),
            components: path.resolve(__dirname, '../client/components'),
            src: path.resolve(__dirname, '../client'),
            package: path.resolve('resources/assets/main/backend/package.json'),
            'vuex-store': path.resolve(__dirname, '../client/store'),
        }
    },
    module: {
        rules: [
            //{
            //  test: /\.(js|vue)$/,
            //  loader: 'eslint-loader',
            //  enforce: 'pre',
            //  include: [resolve('src'), resolve('docs')],
            //  options: {
            //    formatter: require('eslint-friendly-formatter')
            //  }
            //},
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: vueLoaderConfig
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/
            },
            {
                test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
                loader: 'url-loader',
                options: {
                    limit: 10000,
                    name: utils.assetsPath('img/[name].[hash:7].[ext]')
                }
            },
            {
                test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
                loader: 'url-loader',
                options: {
                    limit: 10000,
                    name: utils.assetsPath('fonts/[name].[hash:7].[ext]')
                }
            }
        ]
    }
}
