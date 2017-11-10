import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from '../components/manage/Dashboard'
import Setting from '../components/manage/Setting'
import Example from '../components/Example'

Vue.use(VueRouter)

export default new VueRouter({
    mode:"history",
    base:'/home',
    navs:[
        {
            title:'首页',
            icon: 'el-icon-fa-home',
            path: '/',
        },
        {
            title:'用户中心',
            icon: 'el-icon-fa-user',
            path: '/user'
        },
        {
            title:'在线客服',
            icon: 'el-icon-fa-comment',
            path: '/chat'
        },
        {
            title:'客服机器人',
            icon: 'el-icon-fa-android',
            path: '/robot'
        },
        {
            title:'客户中心',
            icon: 'el-icon-fa-users',
            path: '/customer'
        },
        {
            title:'工单系统',
            icon: 'el-icon-fa-th',
            path: '/order'
        },
        {
            title:'短信中心',
            icon: 'el-icon-fa-envelope',
            path: '/message'
        },
        {
            title:'呼叫中心',
            icon: 'el-icon-fa-phone',
            path: '/call'
        },
        {
            title:'统计分析',
            icon: 'el-icon-fa-pie-chart',
            path: '/analysis'
        },
        {
            title:'系统设置',
            icon: 'el-icon-setting',
            path: '/setting'
        }
    ],
    routes: [
        {
            path: '/',
            component: Dashboard
        },
        {
            path: '/user', 
            component: Example 
        },
        {
            path: '/chat', 
            component: Example 
        },
        {
            path: '/robot', 
            component: Example 
        },
        {
            path: '/customer', 
            component: Example 
        },
        {
            path: '/order', 
            component: Example 
        },
        {
            path: '/message', 
            component: Example 
        },
        {
            path: '/call', 
            component: Example 
        },
        {
            path: '/analysis', 
            component: Example 
        },
        {
            path: '/setting', 
            component: Setting 
        }
    ]
})