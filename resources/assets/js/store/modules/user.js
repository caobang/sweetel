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
    },
    /*addUserGroup(state,group) {
        state.usergroups.push(usergroups)
    },
    editUserGroup(state,group) {
        let item = state.usergroups.find(g=>g.id==group.id)
        if(item){
            item.name=group.name
        }
    },
    delUserGroup(state,groupid) {
        let index = state.usergroups.find(g=>g.id==groupid)
        state.usergroups.splice(index, 1)
    },*/
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
    loadUserData({ commit },groupid,username) {
        return api.getUserData({groupid:groupid,username:username}).then((data)=>{
            commit('setUserData',data)
        })
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}