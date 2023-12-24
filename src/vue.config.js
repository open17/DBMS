// vue.config.js
const { defineConfig } = require('@vue/cli-service');

// 预渲染
const PrerenderSPAPlugin = require('prerender-spa-plugin-next');
 
module.exports = defineConfig({
  transpileDependencies: true,
  publicPath: './'
  // publicPath:"/",
  // prerender-spa-plugin-next预渲染
  // configureWebpack: {
  //   plugins: [
  //     new PrerenderSPAPlugin({
  //       // 需要预渲染的页面，跟router路由一致
  //       routes: [ '/', '/new','/cart','/goods' ],
  //     })
  //   ]
  // },
  // //代理服务器
  // devServer: {
  //   host: 'localhost', // 指定开发服务器的主机名，默认为 localhost
  //   port: 8080, // 指定开发服务器的端口号，默认为 8080
  //   proxy: {
  //     '/api': {
  //       target: 'localhost:3000/backend/test.php',
  //       changeOrigin: true
  //     }
  //   }
  // }
})