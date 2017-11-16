import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from '../components/dashboard/Main'
import Setting from '../components/setting/Main'
import User from '../components/user/Main'
import Chat from '../components/chat/Main'
import Robot from '../components/robot/Main'
import Customer from '../components/customer/Main'
import Order from '../components/order/Main'
import Analysis from '../components/analysis/Main'

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
            component: Chat 
        },
        {
            path: '/robot', 
            component: Robot 
        },
        {
            path: '/customer', 
            component: Customer 
        },
        {
            path: '/order', 
            component: Order 
        },
        {
            path: '/message', 
            component: Dashboard 
        },
        {
            path: '/call', 
            component: Dashboard 
        },
        {
            path: '/analysis', 
            component: Analysis 
        },
        {
            path: '/setting', 
            component: Setting 
        }
    ]
})