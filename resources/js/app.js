require('./bootstrap');
import Vue from 'vue'
import App from './vue/App.vue'
import Vuetify from 'vuetify'
import router from './router/router'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/dist/vuetify.min.css'
import Form from './Form';


window.Form = Form;


Vue.use(Vuetify)
Vue.component('send-mail', require('./vue/components/Contact.vue'));

const opts = {
    icons: {
        iconfont: 'mdi'
    }
}


const app = new Vue({
    el: '#app',
    components: {
        App,
    },
    router,
    vuetify: new Vuetify(opts)
})