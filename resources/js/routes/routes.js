import VueRouter from "vue-router";
import EmpList from "../views/emplist.vue";
import EmpCreate from "../views/empcreate.vue";

console.log('this is router');
const routes = [
    {
        path: '/vue/emp-list',
        name: 'emp-list',
        component: EmpList
    }  
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;