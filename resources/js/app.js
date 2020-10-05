require('./bootstrap');

window.Vue = require('vue');

//Components
Vue.component('header-component', require('./components/Header').default);
Vue.component('footer-component', require('./components/Footer').default);
Vue.component('auth_reg-component', require('./components/Auth_Reg').default);
Vue.component('posts-component', require('./components/Posts').default);
Vue.component('post-component', require('./components/Post').default);
Vue.component('comment-component', require('./components/Comment').default);
Vue.component('userdata-component', require('./components/UserData').default);

//Плагины
import store from './store/';

const app = new Vue({
    store,
    el: '#app'
});



