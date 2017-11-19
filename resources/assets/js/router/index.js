import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from '../components/Dashboard'
import Setting from '../components/Setting'
import User from '../components/User'
import Chat from '../components/Chat'
import Robot from '../components/Robot'
import Customer from '../components/Customer'
import Order from '../components/Order'
import Analysis from '../components/Analysis'

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