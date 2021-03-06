import {api} from '../../api'

// 应用初始状态
const state = {
    userGroups:[{id:1,name:''}],
    roles:[{id:1,name:''}],
    userData:{total:0,list:[]}
}

// 定义getters
const getters = {
    //getUserInfo: state => state.userinfo,
    //getMenus: state => state.menus
}

// 定义mutations
const mutations = {
    setUserGroups(state,userGroups) {
        state.userGroups = userGroups
    },
    setUserData(state,userData) {
        state.userData = userData
    },
    setRoles(state,roles) {
        state.roles = roles
    }
}

// 定义actions
const actions = {
    loadUserGroups ({ commit }) {
        return api.getUserGroups().then((data)=>{
            commit('setUserGroups',data)
        })
    },
    addUserGroup ({ commit },group) {
        return api.addUserGroup(group)
    },
    editUserGroup ({ commit },group) {
        return api.editUserGroup(group)
    },
    delUserGroup ({ commit },id) {
        return api.delUserGroup(id)
    },
    loadRoles ({ commit }) {
        return api.getRoles().then((data)=>{
            commit('setRoles',data)
        })
    },
    loadPagingUsers({ commit },params) {
        return api.getPagingUsers(params).then((data)=>{
            commit('setUserData',data)
        })
    },
    addUser ({ commit },user) {
        return api.addUser(user)
    },
    editUser ({ commit },user) {
        return api.editUser(user)
    },
    delUser ({ commit },id) {
        return api.delUser(id)
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}