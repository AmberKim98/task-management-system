import { required, email } from "vuelidate/lib/validators";

export default {
    data() {
        return {
            position: [ 
                { value:null, text: "Please select a position" },
                { value: 0, text: "Admin" },
                { value:1, text: "Member" }
             ],
            employee: {
                name: "",
                email: "",
                profile: null,
                address: "",
                phone: "",
                dob: "",
                position: ""
            },
            isValid: false
        };
    },
    validations: {
        employee: {
            name: { required },
            email: { required, email },
            profile: { required },
            address: { required },
            phone: { required },
            dob: { required },
            position: { required }
        }
    },
    mounted() {
        console.log('Employee Creation is started...');
    },
    methods: {
        handleFileUpload(event){
            this.employee.profile = event.target.files[0];
        },
        addNewEmployee() {
            console.log('this is add new employee...');
            const data = new FormData();

            data.append('name', this.employee.name);
            data.append('email', this.employee.email);
            data.append('profile', this.employee.profile);
            data.append('address', this.employee.address);
            data.append('phone', this.employee.phone);
            data.append('dob', this.employee.dob);
            data.append('position', this.employee.position);

            this.isValid = true;

            console.log('Employee Info: ',this.employee);

            this.$v.$touch();
            if(this.$v.$invalid) {
                return;
            }
            axios.post('../api/add-new-employee', data,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then( response=> {
                if(response.status === 200) {
                    this.$alert("Successfully Created!", "", "success").then(() => {
                        this.$router.push({ name: 'emp-list' });
                    });
                }
            })
            .catch(err => {
                this.$alert(err);
            });
        },
        onReset(event) {
            event.prevenDefault();
            this.employee_name = '';
            this.email = '';
            this.profile = '';
            this.addresss = '';
            this.phone = '';
            this.dob = '';
            this.position = '';
        }
    }
}