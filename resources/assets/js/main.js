import Vue from "vue";
import Home from "./components/Home.vue";
import DashboardIndex from "./components/DashboardIndex.vue";
import DashboardEdit from "./components/DashboardEdit.vue";
import LoadingIndicator from "./components/LoadingIndicator.vue";

Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=token]').getAttribute('content');

window.$ = window.jQuery = require('jquery');
require('jquery.payment');
window.Tether = function () {
    throw new Error('Your Bootstrap may actually need Tether.');
};
require('bootstrap/dist/js/npm');

Vue.component('loading-indicator', LoadingIndicator);

new Vue({
    el: '#app',
    components: {
        Home,
        DashboardIndex,
        DashboardEdit
    },
    data: {
        user: null
    },
    ready() {
        this.fetchUser();
    },
    methods: {
        fetchUser() {
            this.$http.get('/api/user').then(
                response => {
                    this.user = response.data.user;
                }
            )
        }
    }
});