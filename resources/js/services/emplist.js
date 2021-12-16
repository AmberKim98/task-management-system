import { isEmpty } from "lodash";

export default {
    data() {
        return {
            employee_name: "",
            employee_id: "",
            employees: {},
            page: 1,
            allPosts: true,
            searchPosts: false
        }
    },
    mounted() {
        console.log('employee-list');
        this.getEmployee();
    },
    methods: {
        showEditForm(employee_id) {
        },
        paginationPage(page) {
            this.getEmployee(page);
        },
        paginationPageWithSearch(page) {
            this.searchEmployee(page);
        },
        getEmployee(page) {
            this.searchPosts = false;
            this.allPosts = true;

            if (typeof page === "undefined") { page = 1; }
            axios
            .get('../api/employee-list?page=' + page)
            .then( response => {
                this.employees = response.data;
                console.log('employees', this.employees);
            })
            .catch(err => {
                console.log(err);
            });
        },
        searchEmployee(page) {
            this.searchPosts = true;
            this.allPosts = false;
            if (typeof page === "undefined") { 
                page = 1; 
            }
            if(!isEmpty(this.employee_id))
            {
                axios.get('../api/employee-list/'+ '?employee_id=' + this.employee_id + '&page=' + page)
                .then( response => {
                    this.employees = response.data;
                    console.log('employees', this.employees);
                })
                .catch(err => {
                    console.log(err);
                });
            }
            if(!isEmpty(this.employee_name))
            {
                axios.get('../api/employee-list/'+ '?employee_name=' + this.employee_name + '&page=' + page)
                .then( response => {
                    this.employees = response.data;
                    console.log('employees', this.employees);
                })
                .catch(err => {
                    console.log(err);
                });
            }
            if(!isEmpty(this.employee_id) && !isEmpty(this.employee_name)) {
                axios.get('../api/employee-list/'+ '?employee_id=' + this.employee_id + '&employee_name=' + this.employee_name + '&page=' + page)
                .then( response => {
                    this.employees = response.data;
                    console.log('employees', this.employees);
                })
                .catch(err => {
                    console.log(err);
                });
            }
        },
        createEmployee() {
            this.$router.push({ name: "emp-create" });
        }
    }
}