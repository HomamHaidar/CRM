import './bootstrap';
import Vue from 'vue';
import Kanban from './components/Kanban.vue';

const app = new Vue({
    el: '#app',
    components: { Kanban }
});
