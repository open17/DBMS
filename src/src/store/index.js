import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    showAddressEditor: false,
    address: '',
    loggedIn: false,
    isAdmin: false,
    cart: [],
  },
  getters: {
    getAddress: state => state.address,
    isAddressEditorVisible: state => state.showAddressEditor,
    isLoggedIn: state => state.loggedIn,
    isAdmin: state => state.isAdmin,
    getCart: state => state.cart,
  },
  mutations: {
    setAddress(state, address) {
      state.address = address;
    },
    toggleAddressEditor(state) {
      state.showAddressEditor = !state.showAddressEditor;
    },
    setLoggedIn(state, loggedIn) {
      state.loggedIn = loggedIn;
    },
    setAdmin(state, isAdmin) {
      state.isAdmin = isAdmin;
    },
    addToCart(state, product) {
      state.cart.push(product);
    },
    removeFromCart(state, productId) {
      state.cart = state.cart.filter(item => item.id !== productId);
    },
    removeAllFromCart(state) {
      state.cart = [];
    }
  },
  actions: {
    updateAddress({ commit }, address) {
      // 假设这里有一个异步操作，例如向后端发送请求更新地址
      setTimeout(() => {
        commit('setAddress', address);
      }, 1000);
    },
    updateLoggedIn({ commit }, loggedIn) {
      commit('setLoggedIn', loggedIn);
    },
    updateAdmin({ commit }, isAdmin) {
      commit('setAdmin', isAdmin);
    },
    addToCart({ commit }, product) {
      commit('addToCart', product);
    },
    removeFromCart({ commit }, productId) {
      commit('removeFromCart', productId);
    },
    removeAllFromCart({ commit }){
      commit('removeAllFromCart');
    }
  },
  modules: {},
});