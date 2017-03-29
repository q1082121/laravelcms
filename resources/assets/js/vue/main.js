import Vue from './../../../../node_modules/vue/dist/vue.min.js'
import Lib from './lib.js'
import App from './app.vue'
import VueRouter from './../../../../node_modules/vue-router/dist/vue-router.min.js'
import VueResource from './../../../../node_modules/vue-resource/dist/vue-resource.min.js'
Vue.use(VueRouter)
Vue.use(VueResource)

const homeHome = resolve => {require(['./module/home/home.vue'], resolve)}
const adminHome = resolve => {require(['./module/admin/home.vue'], resolve)}
//路由
const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    { path: '/', component: homeHome },
    { path: '/admin', component: adminHome }
  ]
})
new Vue(Vue.util.extend({ router }, App)).$mount('#appContent')