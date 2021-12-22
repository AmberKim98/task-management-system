import { isEmpty } from "lodash";
import readXlsxFile from "read-excel-file";

export default {
    data() {
        return {
            employee_name: "",
            employee_id: "",
            result_id: "",
            result_name: "",
            employees: {},
            page: 1,
            allPosts: true,
            searchPosts: false,
            loading:false,
            file: null,
            import_file: null
        }
    },
    watch: {
        employee_name: function(newName, oldName) {
            this.result_name = "Waiting for you to stop typing...";
            this.debouncedGetAnswer();
        },
        employee_id: function(newID, oldID) {
            this.result_id = "Waiting for you to stop typing...";
            this.debouncedGetAnswer();
        }
    },
    created() {
        this.debouncedGetAnswer = _.debounce(this.searchEmployee, 500);
    },
    mounted() {
        console.log('employee-list');
        this.getEmployee();
    },
    methods: {
        paginationPage(page) {
            this.getEmployee(page);
        },
        paginationPageWithSearch(page) {
            this.searchEmployee(page);
        },
        getEmployee(page) {
            this.loading = true;
            this.searchPosts = false;
            this.allPosts = true;

            if (typeof page === "undefined") { page = 1; }
            setTimeout(() => {
                this.loading = false;
                axios
                .get('../api/employee-list?page=' + page)
                .then( response => {      
                    this.employees = response.data;
                    console.log('employees', this.employees);
                })
                .catch(err => {
                    console.log(err);
                });
            }, 3000);
            
        },
        searchEmployee(page) {
            this.searchPosts = true;
            this.allPosts = false;
            if (typeof page === "undefined") { 
                page = 1; 
            }
            if(!isEmpty(this.employee_id))
            {
                this.result_id = "Searching...";
                axios.get('../api/employee-list/'+ '?employee_id=' + this.employee_id + '&page=' + page)
                .then( response => {
                    this.employees = response.data;
                    console.log('employees', this.employees);
                    this.result_id = "Searched ID: "+ this.employee_id;
                })
                .catch(err => {
                    console.log(err);
                });
            }
            if(!isEmpty(this.employee_name))
            {
                this.result_name = "Searching...";
                axios.get('../api/employee-list/'+ '?employee_name=' + this.employee_name + '&page=' + page)
                .then( response => {
                    this.employees = response.data;
                    console.log('employees', this.employees);
                    this.result_name = "Searched name: "+ this.employee_name;
                })
                .catch(err => {
                    console.log(err);
                });
            }
            if(!isEmpty(this.employee_id) && !isEmpty(this.employee_name)) {
                this.result_id = "Searching...";
                this.result_name = "Searching...";
                axios.get('../api/employee-list/'+ '?employee_id=' + this.employee_id + '&employee_name=' + this.employee_name + '&page=' + page)
                .then( response => {
                    this.employees = response.data;
                    console.log('employees', this.employees);
                    this.result_id = "Searched ID: "+ this.employee_id;
                    this.result_name = "Searched name: "+ this.employee_name;
                })
                .catch(err => {
                    console.log(err);
                });
            }
        },
        deleteEmployee(employeeId) {
            console.log('delete employee...');
            this.$confirm("Are you sure to delete this employee?", "", 'warning', true).then(() => {
                axios
                    .post("../api/delete-employee/" + employeeId)
                    .then(response => {
                        console.log(response.data);
                        this.$alert(response.data, "", "success").then(() => {
                            location.reload();
                        });

                    })
                    .catch(err => {
                        console.log(err.response.data);
                    });
            });
        },
        downloadEmployeeList() {
            axios
            .get("../api/download-employee", {
                responseType: "arraybuffer",
            })
            .then((response) => {
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement("a");
                fileLink.href = fileURL;
                fileLink.setAttribute("download", "employees.xlsx");
                document.body.appendChild(fileLink);
                fileLink.click();
            });
        },
        onFileChange(event) {
            this.import_file = event.target.files[0];

            readXlsxFile(this.import_file).then((rows) => {
                console.log('rows: ', rows);
            })
        },
        uploadEmployeeList() {
            let formData = new FormData();

            readXlsxFile(this.import_file).then((rows) => {
                console.log('rows: ', rows);
            })
            
            formData.append('import_file', this.import_file);
            
            console.log('Import file..', this.import_file);

            axios.post("../../api/import", formData, {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            })
            .then(response => {
                if(response.status === 200) {
                    console.log(response.data);
                    this.$alert("Successfully created!", "", "success").then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
