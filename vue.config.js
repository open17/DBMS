// vue.config.js
const { defineConfig } = require('@vue/cli-service');

// 预渲染
const PrerenderSPAPlugin = require('prerender-spa-plugin-next');
 
module.exports = defineConfig({
  transpileDependencies: true,
  publicPath:"/",
  // prerender-spa-plugin-next预渲染
  configureWebpack: {
    plugins: [
      new PrerenderSPAPlugin({
        // 需要预渲染的页面，跟router路由一致
        routes: [ '/', '/new','/cart','/goods' ],
      })
    ]
  }
 
})