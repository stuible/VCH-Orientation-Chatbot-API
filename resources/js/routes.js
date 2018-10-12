import VueRouter from 'vue-router';
import Intents from './components/Intents.vue';
import Slots from './components/Slots.vue';
import Landing from './components/Landing.vue';


let routes = [
    {
        path: '/',
        component: Landing
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