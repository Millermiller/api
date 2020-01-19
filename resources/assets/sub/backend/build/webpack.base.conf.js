var path = require('path')
var utils = require('./utils')
var config = require('../config')
var vueLoaderConfig = require('./vue-loader.conf')

function resolve(dir) {
    return path.join(__dirname, '..', dir)
}

module.exports = {
    entry: {
        app: './resources/assets/sub/backend/client/index.js'
    },
    output: {
        path: path.resolve('public/sub/backend'),
        filename: '[name].js',
        publicPath: '/sub/backend/'
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
            package: path.resolve('resources/assets/sub/backend/package.json'),
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
                test: /.vue$/,
                loaders: ['vue-loader']
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
                query: {
                    cacheDirectory: true, // включить кэширование
                    presets: ['es2015'],
                    plugins: ['transform-runtime']
                }
            },
            {
                test: /\.(png|jpe?g|gif|svg)(\?\S*)?$/,
                loader: 'file-loader',
                query: {
                    name: '/frontend/assets/img/[name].[ext]?[hash]'
                }
            },
            {
                test: /\.(eot|svg|ttf|woff|woff2)(\?\S*)?$/,
                loader: 'file-loader',
                query:{
                    name: '/assets/fonts/[name].[ext]'
                }
            },
        ]
    }
}
