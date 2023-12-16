import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta: {
        breadcrumb: 'Home'
      }
  },
  {
    path: '/detail',
    name: 'detail',
    meta: {
        breadcrumb: 'Goods detail'
    },
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/DetailView.vue')
  },
  {
    path: '/review',
    name: 'review',
    meta: {
        breadcrumb: 'Reviews'
      },
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/ReviewView.vue')
  },
  {
    path: '/goods',
    name: 'goods',
    meta: {
        breadcrumb: 'Goods'
      },
    component: () => import(/* webpackChunkName: "about" */ '../views/GoodsView.vue')
  },
  {
    path: '/cart',
    name: 'cart',
    meta: {
        breadcrumb: 'Cart'
      },
    component: () => import(/* webpackChunkName: "about" */ '../views/CartView.vue')
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
