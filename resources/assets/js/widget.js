// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.

import Vue from 'vue'
import Widget from './components/Widget'

Vue.config.productionTip = false


/* eslint-disable no-new */
let component = new Vue({
    //el: '#app',
    render: h => h(Widget)
}).$mount()

document.body.appendChild(component.$el);
