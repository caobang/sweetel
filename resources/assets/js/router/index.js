import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from '../components/dashboard/Main'
import Setting from '../components/setting/Main'
import User from '../components/user/Main'

Vue.use(VueRouter)

export default new VueRouter({
    mode:"history",
    base:'/home',
    routes: [
        {
            path: '/',
            component: Dashboard
        },
        {
            path: '/user', 
            component: User 
        },
        {
            path: '/chat', 
            component: User 
        },
        {
            path: '/robot', 
            component: User 
        },
        {
            path: '/customer', 
            component: User 
        },
        {
            path: '/order', 
            component: User 
        },
        {
            path: '/message', 
            component: User 
        },
        {
            path: '/call', 
            component: User 
        },
        {
            path: '/analysis', 
            component: User 
        },
        {
            path: '/setting', 
            component: Setting 
        }
    ]
})