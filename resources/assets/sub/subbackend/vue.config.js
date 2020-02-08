const path = require('path')

module.exports = {
  publicPath: '/sub/backend',
  outputDir: path.resolve(__dirname, '../../../../public/sub/backend'),
  indexPath: path.resolve(__dirname, '../../../../resources/views/sub/backend/vue.blade.php'),
}
