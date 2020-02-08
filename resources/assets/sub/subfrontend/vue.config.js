const path = require('path')


module.exports = {
  chainWebpack: (config) => {
    config
      .plugin('html')
      .tap(args => [
        {
          //  filename: path.resolve(__dirname, './server/templates/test.html'),
          template: path.resolve(__dirname, './indextmpl.html'),
        },
      ]);
  },
  publicPath: '/sub/frontend',
  outputDir: path.resolve(__dirname, '../../../../public/sub/frontend'),
  indexPath: path.resolve(__dirname, '../../../../resources/views/sub/frontend/index.blade.php'),

}
