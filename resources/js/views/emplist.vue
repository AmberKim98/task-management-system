<template>
    <div>
        <table class="emp-list-tbl table table-responsive-lg shadow-sm p-3 mb-5 bg-white rounded table-striped text-center table-hover">
            <thead class="bg-dark text-light">
                <tr>
                    <th scope="col" class="align-middle">Employee ID</th>
                    <th scope="col" class="align-middle">Employee Name</th>
                    <th scope="col" class="align-middle">Email</th>
                    <th scope="col" class="align-middle">Address</th>
                    <th scope="col" class="align-middle">Phone</th>
                    <th scope="col" class="align-middle">DOB</th>
                    <th scope="col" class="align-middle">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="employee in employees.data" :key="employee.employee_id">
                    <td>{{ employee.employee_id }}</td>
                    <td>{{ employee.employee_name }}</td>
                    <td>{{ employee.email }}</td>
                    <td>{{ employee.address }}</td>
                    <td>{{ employee.phone }}</td>
                    <td>{{ employee.dob }}</td>
                    <td>
                        <button class="btn btn-success" @click="showEditForm(employee.employee_id)">Show</button>
                        <button class="btn btn-primary offset-md-1" @click="showEditForm(employee.employee_id)">Edit</button>
                        <button class="btn btn-danger offset-md-1" @click="showEditForm(employee.employee_id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
   
        <div class="container d-flex justify-content-center">
            <pagination :data="employees" @pagination-change-page="paginationPage"></pagination>
        </div>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            employees: {},
            page: 1
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
        getEmployee(page) {
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
        }
    }
}
</script>
