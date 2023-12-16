import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    showAddressEditor: false,
    address: '',
  },
  getters: {
    getAddress: state => state.address,
    isAddressEditorVisible: state => state.showAddressEditor,
  },
  mutations: {
    setAddress(state, address) {
      state.address = address;
    },
    toggleAddressEditor(state) {
      state.showAddressEditor = !state.showAddressEditor;
    },
  },
  actions: {
    updateAddress({ commit }, address) {
      // 假设这里有一个异步操作，例如向后端发送请求更新地址
      setTimeout(() => {
        commit('setAddress', address);
      }, 1000);
    },
  },
  modules: {},
});