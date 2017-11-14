import {api} from '../../api'

// 应用初始状态
const state = {
    usergroups:[],
    userdata:{total:0,list:[]}
}

// 定义getters
const getters = {
    //getUserInfo: state => state.userinfo,
    //getMenus: state => state.menus
}

// 定义mutations
const mutations = {
    setUserGroups(state,usergroups) {
        state.usergroups = usergroups
    },
    setUserData(state,userdata) {
        state.userdata = userdata
    },
    addUserGroup(state,group) {
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
    }
}

// 定义actions
const actions = {
    loadUserGroups ({ commit }) {
        api.getUserGroups().then((data)=>{
            commit('setUserGroups',data)
        })
    },
    getUserData({ commit },groupid,username) {
        api.getUserData({groupid:groupid,username:username}).then((data)=>{
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