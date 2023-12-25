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
    {
    path: '/checkout',
    name: 'checkout',
    meta: {
        breadcrumb: 'Checkout'
      },
    component: () => import(/* webpackChunkName: "about" */ '../views/CheckoutView.vue')
  },
  {
    path: '/info',
    name: 'info',
    meta: {
        breadcrumb: 'Info'
      },
    component: () => import(/* webpackChunkName: "about" */ '../views/AddressView.vue')
  },
  {
    path: '/order',
    name: 'order',
    meta: {
        breadcrumb: 'order'
      },
    component: () => import(/* webpackChunkName: "about" */ '../views/OrderView.vue')
  },
  {
    path: '/login',
    name: 'login',
    meta: {
        breadcrumb: 'Login'
      },
    component: () => import(/* webpackChunkName: "about" */ '../views/LoginView.vue')
  },
  {
    path: '/signup',
    name: 'signup',
    meta: {
        breadcrumb: 'Signup'
      },
    component: () => import(/* webpackChunkName: "about" */ '../views/SignupView.vue')
  },
  {
    path: '/admin',
    name: 'admin',
    meta: {
        breadcrumb: 'Admin'
      },
    component: () => import(/* webpackChunkName: "about" */ '../views/AdminView.vue')
  },
]

const router = new VueRouter({
  mode: 'hash',
  base: process.env.BASE_URL,
  routes
})

export default router
