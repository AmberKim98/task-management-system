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
            isValid: false,
            oldProfile: null,
            newProfile: null,
        }
    },
    validations() {
        const isImageType = this.employee.profile['type'] == 'image/png' || this.employee.profile['type'] == 'image/jpg' || this.employee.profile['type'] == 'image/jpeg';

        if(this.changePwd === 'yes') {
            return {
                employee: {
                    employee_name: { required },
                    email: { email },
                    address: { maxLength: maxLength(255) },
                    profile: isImageType,
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
                    address: { maxLength: maxLength(255) },
                    profile: isImageType
                }
            }
        }
    },
    mounted() {
        axios.get('../../api/employee-list/'+this.$route.params.id)
        .then(response => {
            this.employee.employee_id =response.data.employee_id;
            this.employee.employee_name =response.data.employee_name; 
            this.employee.email =response.data.email; 
            this.employee.profile =response.data.profile; 
            this.employee.address =response.data.address; 
            this.employee.phone =response.data.phone; 
            this.employee.dob =response.data.dob; 
            this.employee.position =response.data.position; 
            if(this.employee.profile == 'profile.png')
            {
                this.employee.profile = "https://www.nicepng.com/png/detail/933-9332131_profile-picture-default-png.png";
            }
            var profile = new Blob([this.employee.profile], { type: 'image/png'});
            console.log(profile);
        })
        .catch(err => {
            console.log(err);
        });
    },
    updated() {
        console.log(this.employee.old_password);
    },  
    methods: {
        readProfileImage(url) {
            const response = Promise.all([url]);
            const ext = url.split(".").pop();
            const filename = url.split("/").pop();
            console.log(ext, filename);
            const metadata = { type: 'image/png' };
            return new File([response], filename, metadata);
        },
        handleFileUpload(event){
            this.newProfile = event.target.files[0];
            this.previewImage(this.newProfile);
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
            const data = new FormData();
            data.append('employee_id', this.employee.employee_id);
            data.append('name', this.employee.employee_name);
            data.append('email', this.employee.email);
            data.append('profile', this.newProfile);
            data.append('old_password', this.employee.old_password);
            data.append('new_password', this.employee.new_password);
            data.append('new_password_confirmation', this.employee.confirm_password);
            data.append('address', this.employee.address);
            data.append('phone', this.employee.phone);
            data.append('dob', this.employee.dob);
            data.append('position', this.employee.position);

            this.isValid = true;
            console.log(data.get('profile'));

            this.$v.$touch();
            if(this.$v.$invalid) {
                return;
            }

            axios.post('../../api/edit-employee/'+ this.employee.employee_id, data,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                console.log('Profile after uploading....', this.employee.profile);
                this.$router.push({name: 'emp-list'});
            })
            .catch(err => {
                this.$alert("Request failed with validation errors!", "", "error");
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