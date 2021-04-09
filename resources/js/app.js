require('./bootstrap');

require('alpinejs');
window.Vue = require('vue').default;
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
