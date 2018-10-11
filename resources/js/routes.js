import VueRouter from 'vue-router';
import Intents from './components/Intents.vue';
import Slots from './components/Slots.vue';


let routes = [
    {
        path: '/',
        component: Intents
    },
    {
        path: '/:intentName',
        component: Slots,
        props: true
    }
];


export default new VueRouter({
    routes
});