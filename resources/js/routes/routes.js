import VueRouter from "vue-router";
import EmpList from "../views/EmployeeList.vue";
import EmpCreate from "../views/EmployeeCreate.vue";
import EmpProfile from "../views/EmployeeProfile.vue";
import EmpUpdate from "../views/EmployeeUpdate.vue";

console.log('this is router');
const routes = [
    {
        path: '/vue/emp-list',
        name: 'emp-list',
        component: EmpList
    },
    {
        path: '/vue/emp-create',
        name: 'emp-create',
        component: EmpCreate
    },
    {
        path: '/vue/emp-profile/:id',
        name: 'emp-profile',
        component: EmpProfile,
    },
    {
        path: '/vue/emp-update/:id',
        name: 'emp-update',
        component: EmpUpdate,
    }   
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;