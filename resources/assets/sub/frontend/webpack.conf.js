var path = require('path');
var webpack = require('webpack');
var BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

module.exports = {
    entry: './resources/assets/sub/frontend/src/main.js',
    output:  {
        path: path.resolve('public/sub/frontend'),
        filename: 'build.js',
        publicPath: '/sub/frontend'
    },
    module: {
        // Special compilation rules
        rules: [
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
                test: /.vue$/,
                loaders: ['vue-loader']
            },
            {
                test: /\.css$/,
                loader: 'style-loader!css-loader'
            },
            {
                test: /\.(eot|svg|ttf|woff|woff2)(\?\S*)?$/,
                loader: 'file-loader',
                query:{
                    name: '/assets/fonts/[name].[ext]'
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
                test: /\.sass$/,
                loaders: ['style','css','sass']
            }
        ]
    },
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.common.js',
            'babel': 'babel-core/index.js'
        }
    },
    performance: {
        hints: false
    },
    //plugins: [new BundleAnalyzerPlugin()]
    //devtool: 'eval',
};

if (process.env.NODE_ENV === 'production') {
    module.exports.devtool = '#source-map'
    // http://vue-loader.vuejs.org/en/workflow/production.html
    module.exports.plugins = (module.exports.plugins || []).concat([
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        }),
        new webpack.optimize.UglifyJsPlugin({
            sourceMap: true,
            compress: {
                warnings: false
            }
        }),
        new webpack.LoaderOptionsPlugin({
            minimize: true
        })
    ])
}

