<template>
    <div class="container-fluid col-md-6">
        <b-card>
        <b-card-title>Employee Creation Form</b-card-title>
        <b-card-body>
        <b-form @submit.prevent="addNewEmployee" @reset="onReset">
            <b-form-group id="input-group-1" label="Employee Name:" label-for="name">
                <b-form-input type="text" id="name" v-model="employee.name" v-bind:class="{ 'is-invalid': isValid && $v.employee.name.$error }"></b-form-input>
                <div v-if="isValid && !$v.employee.name.required" class="invalid-feedback">
                    Employee Name is required.
                </div>
            </b-form-group>

            <b-form-group id="input-group-2" label="Email:" label-for="email" class="mt-3">
                <b-form-input id="email" type="email" v-model="employee.email" v-bind:class="{ 'is-invalid': isValid && $v.employee.email.$error }"></b-form-input>
                <div v-if="isValid && !$v.employee.email.required" class="invalid-feedback">
                   Email is required.
                </div>
                <div v-if="isValid && !$v.employee.email.email" class="invalid-feedback">
                   Email is invalid.
                </div>
            </b-form-group>

            <b-form-group id="input-group-3" label="Profile Picture:" label-for="profile" class="mt-3">
                <b-form-file id="profile" v-model="employee.profile" plain v-bind:class="{ 'is-invalid': isValid && $v.employee.profile.$error }" accept="image/png, image/jpeg, image/jpg" @change="handleFileUpload($event)"></b-form-file>
                <div v-if="isValid && !$v.employee.profile.required" class="invalid-feedback">
                   Profile picture is required.
                </div>
            </b-form-group>

            <b-form-group id="input-group-4" label="Address:" label-for="address" class="mt-3">
                <b-form-textarea id="address" v-model="employee.address" v-bind:class="{ 'is-invalid': isValid && $v.employee.address.$error }"></b-form-textarea>
                <div v-if="isValid && !$v.employee.address.required" class="invalid-feedback">
                    Address is required.
                </div>
            </b-form-group>

            <b-form-group id="input-group-5" label="Phone:" label-for="phone" class="mt-3">
                <b-form-input id="phone" type="tel" v-model="employee.phone" v-bind:class="{ 'is-invalid': isValid && $v.employee.phone.$error }"></b-form-input>
                <div v-if="isValid && !$v.employee.phone.required" class="invalid-feedback">
                        Phone Number is required.
                </div>
            </b-form-group>

            <b-form-group id="input-group-6" label="Date of Birth:" label-for="dob" class="mt-3">
                <b-form-input id="dob" type="date" v-model="employee.dob" v-bind:class="{ 'is-invalid': isValid && $v.employee.dob.$error }"></b-form-input>
                <div v-if="isValid && !$v.employee.dob.required" class="invalid-feedback">
                   Date of Birth is required.
                </div>
            </b-form-group>

            <b-form-group id="input-group-7" label="Position:" label-for="position" class="mt-3">
                <b-form-select id="position" v-model="employee.position" :options="position" class="form-select" v-bind:class="{ 'is-invalid': isValid && $v.employee.position.$error }"></b-form-select>
                <div v-if="isValid && !$v.employee.position.required" class="invalid-feedback">
                    Position is required.
                </div>
            </b-form-group>

            <div class="container-fluid d-flex justify-content-center mt-4">
                <b-button type="submit" variant="primary" class="col-md-3 mx-4">Save</b-button>
                <b-button type="reset" variant="danger" class="col-md-3">Cancel</b-button>
            </div>
            
        </b-form>
        </b-card-body>
        </b-card>
    </div>
</template>

<script src="../services/employee-create.js"></script>