<template>
    <div class="container-fluid col-md-6">
        <b-card>
            <b-card-title>Employee Profile</b-card-title>
            <b-card-body>
                <b-form>
                    <b-form-group class="mb-3">
                        <label for="employee_name" class="col-md-5">Employee Name: </label>
                        <span class="col-md-5 fw-bold">{{ employee.employee_name }}</span>
                    </b-form-group>
                    <b-form-group class="mb-3">
                        <label for="email" class="col-md-5">Email: </label>
                        <span class="col-md-5 fw-bold">{{ employee.email }}</span>
                    </b-form-group>
                    <b-form-group class="mb-3">
                        <label for="profile" class="col-md-5">Profile Picture: </label>
                        <span class="col-md-5 fw-bold"><img :src="employee.profile" height="120"></span>
                    </b-form-group>
                    <b-form-group class="mb-3">
                        <label for="position" class="col-md-5">Position: </label>
                        <span class="col-md-5 fw-bold" v-if="employee.position == 0">Admin</span>
                        <span class="col-md-5 fw-bold" v-else>Member</span>
                    </b-form-group>
                    <b-form-group class="mb-3">
                        <label for="address" class="col-md-5">Address: </label>
                        <span class="col-md-5 fw-bold">{{ employee.address }}</span>
                    </b-form-group>
                    <b-form-group class="mb-3">
                        <label for="dob" class="col-md-5">Date of Birth: </label>
                        <span class="col-md-5 fw-bold">{{ employee.dob }}</span>
                    </b-form-group>
                    <b-form-group class="mb-3">
                        <label for="phone" class="col-md-5">Phone: </label>
                        <span class="col-md-5 fw-bold">{{ employee.phone }}</span>
                    </b-form-group>

                    <div class="d-flex justify-content-center">
                        <b-button type="submit" variant="success" class="col-md-3 mx-4" @click="$router.push({ name: 'emp-update' })">Edit</b-button>
                    </div>
                    
                </b-form>
            </b-card-body>
        </b-card>
    </div>
</template>

<script src="../services/employee-profile.js"></script>
