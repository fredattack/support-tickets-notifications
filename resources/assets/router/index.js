import {createRouter, createWebHistory} from 'vue-router'
import TicketList from "../components/TicketList";
import NotFound from "../components/NotFound";
import NewTicketComponent from "../components/TicketShow/NewTicketComponent";
import NewFeatureComponent from "../components/NewFeatureComponent";
import TicketShow from "../components/TicketShow/TicketShow";
import FeatureVue from "../components/FeatureVue";

const routes = [
    {
        path: '/support-ticket',
        name:'home',
        component: TicketList
    },
    {
        path: '/support-ticket/archived',
        name:'archived',
        component: TicketList
    },
    {
        path: '/support-ticket/:id',
        name:'show-ticket',
        props:true,
        component: TicketShow
    },
    {
        path: '/support-ticket/new',
        name:'new-ticket',
        component: NewTicketComponent
    },
    {
        path: '/support-ticket/feature',
        name:'features-list',
        component: NewFeatureComponent
    },
    {
        path: '/support-ticket/feature/:id',
        name:'show-feature',
        props:true,
        component: FeatureVue
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return savedPosition || { left: 0, top: 0 }
    }
})


export default router





















