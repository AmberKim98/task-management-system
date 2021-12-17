import { max } from "lodash";
import { required, email, maxLength, requiredIf, minLength, sameAs } from "vuelidate/lib/validators";

export default {
    data() {
        return {
            position: [ 
                { value:null, text: "Please select a position" },
                { value: 0, text: "Admin" },
                { value:1, text: "Member" }
             ],
            employee: {
                employee_name: "",
                email: "",
                password: "",
                profile: null,
                address: "",
                phone: "",
                dob: "",
                position: "",
                old_password: "",
                new_password: "",
                confirm_password: ""
            },
            changePwd: 'no',
            changePwdOptions: [
                { key:'yes', value:"Yes" },
                { key:'no', value:"No" }
            ],
            isValid: false
        }
    },
    validations() {
        if(this.changePwd === 'yes') {
            return {
                employee: {
                    employee_name: { required },
                    email: { email },
                    address: { maxLength: maxLength(255) },
                    old_password: { required: requiredIf(function() {
                        return this.changePwd;
                    }) 
                },
                    new_password: { required: requiredIf(function() {
                        return this.changePwd;
                    }), minLength: minLength(6) 
                },
                    confirm_password: { required: requiredIf(function() {
                        return this.changePwd;
                    }), sameAsPassword: sameAs('new_password') 
                }
            }
        }
        }
        else {
            return {
                employee: {
                    employee_name: { required },
                    email: { email },
                    address: { maxLength: maxLength(255) }
                }
            }
        }
    },
    mounted() {
        axios.get('../../api/employee-list/'+this.$route.params.id)
        .then(response => {
            this.employee = response.data;
            console.log(this.employee.profile);
        })
        .catch(err => {
            console.log(err);
        });
        
        console.log(this.employee);
    },
    methods: {
        handleFileUpload(event){
            this.employee.profile = event.target.files[0];
            this.previewImage(this.employee.profile);
        },
        previewImage(profile) {
            const image = document.getElementById('preview');
            const reader = new FileReader();
            reader.onload = function(event) {
                image.src = event.target.result;
                console.log('source...',image.src);
            }
            reader.readAsDataURL(profile);
        },
        updateEmployee() {
            console.log('updated data ...',this.employee.profile);
            const data = new FormData();
            // const reader = new FileReader();
            // reader.readAsDataURL(this.employee.profile);

            data.append('employee_id', this.employee.employee_id);
            data.append('name', this.employee.employee_name);
            data.append('email', this.employee.email);
            data.append('profile', this.employee.profile);
            data.append('address', this.employee.address);
            data.append('phone', this.employee.phone);
            data.append('dob', this.employee.dob);
            data.append('position', this.employee.position);

            this.isValid = true;

            // if(!this.employee.profile) {
            //     data.append('profile', this.employee.profile)
            // }

            this.$v.$touch();
            if(this.$v.$invalid) {
                return;
            }

            axios.post('../../api/edit-employee/'+ this.$route.params.id, data,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                console.log('Updated profile....', this.employee.profile);
                this.$router.push({name: 'emp-list'});
            })
            .catch(err => {
                console.log(err);
            });  
        },
        onReset(event) {
            this.employee_name = '';
            this.email = '';
            this.profile = '';
            this.addresss = '';
            this.phone = '';
            this.dob = '';
            this.position = '';
            this.removePreviewImg();
        },
        removePreviewImg() {
            const image = document.getElementById('preview');
            image.src = "";
        }
    }
}