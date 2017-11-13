import Vue from 'vue'
import ElementUI from 'element-ui'
import router from './router'
import store from './store'
import Home from './components/Home'

Vue.config.productionTip = false

Vue.use(ElementUI)

/* eslint-disable no-new */
new Vue({
    //el: '#app',
    router,
    store,
    render: h => h(Home),
    beforeCreate:function(){
        const loading = this.$loading({text: '系统初始化...'})
        this.$store.dispatch('initApp').then(() => {
            this.$mount('#app')
            loading.close()
        })
    }
})