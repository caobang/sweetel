import Vue from 'vue'
import Vuex from 'vuex'
import user from './modules/user'
import setting from './modules/setting'
import {api,apiwidget} from '../api'

Vue.use(Vuex)

// 应用初始状态
const state = {
    userinfo:{},
    menus: []
}

// 定义getters
const getters = {
    //getUserInfo: state => state.userinfo,
    //getMenus: state => state.menus
}

// 定义mutations
const mutations = {
    initUserInfo(state,userinfo) {
        state.userinfo=userinfo
    },
    initMenus(state,menus) {
        state.menus=menus
    }
}

// 定义actions
const actions = {
    initApp ({ commit }) {
        //apiwidget.getConfig(1).then((data)=>{   
        //    alert(data.tid)
        //})
        api.getUserInfo().then((data)=>{   
            commit('initUserInfo',data)
        })
        return api.getUserMenus().then((data)=>{   
            commit('initMenus',data)
        })
    }
  }

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions
  //modules: {
  //  user,
  //  setting
  //}
})