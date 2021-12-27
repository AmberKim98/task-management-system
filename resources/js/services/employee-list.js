import axios from "axios";
import { isEmpty } from "lodash";
import readXlsxFile from "read-excel-file";

export default {
    data() {
        return {
            employee_name: "",
            employee_id: "",
            employees: {},
            page: 1,
            allPosts: true,
            searchPosts: false,
            loading:false,
            file: null,
            import_file: null,
            totalCount: 0,
            currentPage: 1
        }
    },
    mounted() {
        this.getEmployee();
    },
    computed: {
        getTotalEmployees() {
            this.totalCount = this.employees.total;
            return this.totalCount;
        },
        getCurrentPage() {
            this.currentPage = this.employees.current_page;
            return this.currentPage;
        },
        records: {
            get() {
                return this.employees.data.length;
            }
        }
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
                axios.get('../api/employee-list/'+ '?employee_id=' + this.employee_id + '&page=' + page)
                .then( response => {
                    this.employees = response.data;
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
                })
                .catch(err => {
                    console.log(err);
                });
            }
            if(!isEmpty(this.employee_id) && !isEmpty(this.employee_name)) {
                axios.get('../api/employee-list/'+ '?employee_id=' + this.employee_id + '&employee_name=' + this.employee_name + '&page=' + page)
                .then( response => {
                    this.employees = response.data;
                })
                .catch(err => {
                    console.log(err);
                });
            }
        },
        deleteEmployee(employeeId) {
            this.$confirm("Are you sure to delete this employee?", "", 'warning', true).then(() => {
                axios
                    .post("../api/delete-employee/" + employeeId)
                    .then(response => {
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
        },
        uploadEmployeeList() {
            let formData = new FormData();
            
            formData.append('import_file', this.import_file);

            axios.post("../../api/import", formData, {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            })
            .then(response => {
                if(response.status === 200) {
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
