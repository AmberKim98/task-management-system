<template>
    <div>
        <div class="d-flex fluid mb-4 flex-row">
            <div class="d-flex col-md-9">
                <b-form-group label="Employee ID: " label-for="employee_id" class="col-md-3">
                    <b-form-input type="search" v-model="employee_id" id="employee_id" name="employee_id"></b-form-input>
                </b-form-group>
                <b-form-group label="Employee Name: " label-for="employee_name" class="col-md-5 mx-4">
                    <b-form-input type="search" v-model="employee_name" id="employee_name" name="employee_name"></b-form-input>
                </b-form-group> 
                <b-col lg="4" class="pt-4"><b-button @click.prevent="searchEmployee()">Search</b-button></b-col>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <b-button variant="primary" @click.prevent="createEmployee()">Create New Employee&nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i></b-button>
            </div>
            
        </div>
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
            <pagination v-if="allPosts" :data="employees" @pagination-change-page="paginationPage"></pagination>
            <pagination v-if="searchPosts" :data="employees" @pagination-change-page="paginationPageWithSearch"></pagination>
        </div>
        
    </div>
</template>

<script src="../services/emplist.js"></script>