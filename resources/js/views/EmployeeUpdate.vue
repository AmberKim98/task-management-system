<template>
    <div class="container-fluid col-md-6">
        <b-card>
            <b-card-title>Employee Update Form</b-card-title>
            <b-card-body>
                <b-form @submit.prevent="updateEmployee">
                    <b-form-group id="input-group-1" label="Employee Name:" label-for="employee_name">
                        <b-form-input type="text" id="employee_name" v-model="employee.employee_name" v-bind:class="{ 'is-invalid': isValid && $v.employee.employee_name.$error }"></b-form-input>
                        <div v-if="isValid && !$v.employee.employee_name.required" class="invalid-feedback">
                            Employee Name is required.
                        </div>
                     </b-form-group>

                    <b-form-group id="input-group-2" label="Email:" label-for="email">
                        <b-form-input type="email" id="email" v-model="employee.email" v-bind:class="{ 'is-invalid': isValid && $v.employee.email.$error }"></b-form-input>
                        <div v-if="isValid && !$v.employee.email.email" class="invalid-feedback">
                            Email is incorrect.
                        </div>
                     </b-form-group>

                     <b-form-group id="input-group-3" label="Profile Picture:" label-for="profile" class="mt-3">
                        <div v-if="employee.profile"><img :src="employee.profile" height="120" id="preview" class="mt-2"></div>
                        <input type="hidden" v-model="oldProfile">
                        <b-form-file id="profile" v-model="newProfile" accept="image/png, image/jpg, image/jpeg" @change="handleFileUpload($event)" class="mt-3" :class="{ 'is-invalid': isValid && $v.newProfile.$error }" plain></b-form-file>
                        <div v-if="isValid && !$v.newProfile.isImageType" class="invalid-feedback">
                            Profile picture must be png,jpg and jpeg.
                        </div>
                    </b-form-group>

                    <b-form-group id="input-group-4" label="Address:" label-for="address" class="mt-3">
                        <b-form-textarea id="address" v-model="employee.address" v-bind:class="{ 'is-invalid': isValid && $v.employee.address.$error }"></b-form-textarea>
                        <div v-if="isValid && !$v.employee.address.maxLength" class="invalid-feedback">
                            Address is exceeded from maximum length.
                        </div>
                    </b-form-group>

                    <b-form-group id="input-group-5" label="Phone:" label-for="phone" class="mt-3">
                        <b-form-input id="phone" type="tel" v-model="employee.phone"></b-form-input>
                    </b-form-group>

                    <b-form-group id="input-group-6" label="Date of Birth:" label-for="dob" class="mt-3">
                        <b-form-input id="dob" type="date" v-model="employee.dob"></b-form-input>
                    </b-form-group>

                    <b-form-group id="input-group-7" label="Position:" label-for="position" class="mt-3">
                        <b-form-select id="position" v-model="employee.position" :options="position" class="form-select"></b-form-select>
                    </b-form-group>

                    <b-form-group id="input-group-8" label="Change Password?" label-for="changePwd" class="mt-3">
                        <b-form-radio-group :options="changePwdOptions" v-model="changePwd" value-field="key" text-field="value" class="mt-2"></b-form-radio-group>
                    </b-form-group>    

                    <div v-show="changePwd === 'yes'">
                        <b-form-group id="input-group-9" label="Current Password:" label-for="old_pwd" class="mt-3">
                            <b-form-input v-if="changePwd === 'yes'" type="password" v-model="employee.old_password" v-bind:class="{ 'is-invalid': isValid && $v.employee.old_password.$error }"></b-form-input>
                            <b-form-input v-else type="password" v-model="employee.old_password"></b-form-input>
                            <div v-if="changePwd === 'yes' && isValid && !$v.employee.old_password.required" class="invalid-feedback">
                                Current password is required.
                            </div>
                        </b-form-group>

                        <b-form-group id="input-group-10" label="New Password:" label-for="new_pwd" class="mt-3">
                            <b-form-input v-if="changePwd === 'yes'" type="password" v-model="employee.new_password" v-bind:class="{ 'is-invalid': isValid && $v.employee.new_password.$error }"></b-form-input>
                            <b-form-input v-else type="password" v-model="employee.new_password"></b-form-input>
                            <div v-if="changePwd === 'yes' && isValid && !$v.employee.new_password.required" class="invalid-feedback">
                                New password is required.
                            </div>
                            <div v-if="changePwd === 'yes' && isValid && !$v.employee.new_password.minLength" class="invalid-feedback">
                                New password must be at least 6 characters.
                            </div>
                        </b-form-group>

                        <b-form-group id="input-group-11" label="Confirm Password:" label-for="confirm_password" class="mt-3">
                            <b-form-input v-if="changePwd === 'yes'" type="password" v-model="employee.confirm_password" v-bind:class="{ 'is-invalid': isValid && $v.employee.confirm_password.$error }"></b-form-input>
                            <b-form-input v-else type="password" v-model="employee.confirm_password"></b-form-input>
                            <div v-if="changePwd === 'yes' && isValid && !$v.employee.confirm_password.required" class="invalid-feedback">
                                Confirm password is required.
                            </div>
                            <div v-if="changePwd === 'yes' && isValid && !$v.employee.confirm_password.sameAsPassword" class="invalid-feedback">
                                Confirm password does not match with the new password.
                            </div>
                        </b-form-group>
                    </div>
                    

                     <div class="container-fluid d-flex justify-content-center mt-4">
                        <b-button type="submit" variant="primary" class="col-md-3 mx-4">Save</b-button>
                        <b-button type="reset" variant="danger" class="col-md-3" @click.prevent="$router.push({ name:'emp-list' })">Cancel</b-button>
                    </div>
                </b-form>
            </b-card-body>
        </b-card>
    </div>
</template>

<script src="../services/employee-update.js"></script>