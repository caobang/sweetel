import {api} from '../../api'

// 应用初始状态
const state = {
    userGroups:[{}],
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
        //state.userGroups.unshift({id:-1,name:'全部',parent_id:0})
    },
    setUserData(state,userData) {
        state.userData = userData
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
    loadUserData({ commit },params) {
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