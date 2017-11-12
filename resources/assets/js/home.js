import Vue from 'vue'
import ElementUI from 'element-ui'
import router from './router'
import store from './store'
import Home from './components/Home'

Vue.config.productionTip = false

Vue.use(ElementUI)

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    store,
    render: h => h(Home)
})