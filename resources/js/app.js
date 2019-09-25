require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(VueRouter)
Vue.use(Vuetify)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('employee-component', require('./components/EmployeeComponent.vue').default);
Vue.component('baseline-component', require('./components/BaselineComponent.vue').default);
// Vue.component('create-employee-component', require('./components/CreateEmployeeComponent.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdiSvg', // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4'
          },
    }),
    // router,
});
