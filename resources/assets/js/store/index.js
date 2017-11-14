import Vue from 'vue'
import Vuex from 'vuex'
import user from './modules/user'
import setting from './modules/setting'
import axios from 'axios'
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
    setUserInfo(state,userinfo) {
        state.userinfo = userinfo
    },
    setMenus(state,menus) {
        state.menus = menus
    },
    setUserStatus(state,status) {
        state.userinfo.status = status
    }
}

// 定义actions
const actions = {
    initApp ({ commit }) {
        //apiwidget.getConfig(12).then((data)=>{   
        //    alert(data.tid)
        //})
        //return
        return axios.all([api.getUserInfo(),api.getUserMenus()])
        .then(axios.spread((userInfo,menus)=>{ 
            commit('setUserInfo',userInfo) 
            commit('setMenus',menus)
        }));
    },
    updateUserStatus({ commit },status) {
        api.updateUserStatus({status:status}).then(()=>{
            commit('setUserStatus',status)
        })
    }
}

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions,
    modules: {
        user,
        //setting
    }
})