<template>
    <div class="container">   
        <div class="row justify-content-center pa-0">
            <div class="col-md-10">
                <div class="row justify-content-left">
                    <v-alert type="error" v-show="errorAlert">
                        I'm an error alert.
                    </v-alert>
                </div>
                <v-card class="mx-auto">
                    <v-card-title>
                        Listado de empleados
                    </v-card-title>
                    <v-simple-table>
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Correo</th>
                                <th>Cargo</th>
                                <th>Área</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in employees" :key="index">
                                <td class="text-left">{{ item.name }} {{ item.last_name }}</td>
                                <td class="text-left">{{ item.email }}</td>
                                <td class="text-left">{{ item.position }}</td>
                                <td class="text-left">{{ item.area }}</td>
                                <td class="text-left">
                                    <v-btn text icon @click="showEmployee(item)" color="green"><v-icon>mdi-eye</v-icon></v-btn>
                                    <v-btn text icon @click="editEmployee(item)" color="blue"><v-icon>mdi-pencil</v-icon></v-btn>
                                    <v-btn text icon @click="deleteEmployee(item, index)" color="red"><v-icon>mdi-delete</v-icon></v-btn>
                                </td>
                            </tr>
                        </tbody>
                    </v-simple-table>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-btn class="mx-2" fab dark color="indigo" @click="newEmployee()">
                            <v-icon dark>mdi-plus</v-icon>
                        </v-btn>
                    </v-card-actions>
                </v-card>    
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <v-card>
                    <v-card-title>
                        Datatable
                        <div class="flex-grow-1"></div>
                        <v-text-field
                            v-model="search"
                            label="Search"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-card-title>
                    <v-data-table
                        :headers="headers"
                        :items="employees"
                        :search="search"
                    ></v-data-table>
                </v-card>
            </div>
        </div>

        <v-dialog v-model="showDetail" max-width="500px">
            <v-card>
                <v-card-title>{{ employee.name }} {{ employee.last_name }}</v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col>Email: {{ employee.email }}</v-col>
                        <v-col>Documento: {{ employee.document }}</v-col>
                    </v-row>
                    <v-row>
                        <v-col>Cargo: {{ employee.position }}</v-col>
                        <v-col>Área: {{ employee.area }}</v-col>
                    </v-row>
                    <v-row>
                        <v-col>Salario: {{ employee.salary }}</v-col>
                    </v-row>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn color="red darken-1" text @click="showDetail = false" @add-employee="addEmployee">Cerrar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="editEmployeeForm" persistent max-width="600px">
            <v-card>
                <form @submit.prevent="updateEmployee">
                    <v-card-title>
                        <span class="headline">Editar empleado</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" sm="6">
                                    <v-text-field label="* Nombre" v-model="employee.name" required></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-text-field label="* Apellidos" v-model="employee.last_name" required></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field label="* Email" v-model="employee.email" required></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-text-field label="* Documento" v-model="employee.document" required></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-text-field label="* Salario" v-model="employee.salary" required></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-text-field label="Cargo" v-model="employee.position"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-text-field label="Área" v-model="employee.area"></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                        <small>* campos obligatorios</small>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <div class="flex-grow-1"></div>
                        <v-btn color="red darken-1" text @click="editEmployeeForm = false">Cancelar</v-btn>
                        <v-btn color="green darken-1" text type="submit">Guardar cambios</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-dialog>
        <v-dialog v-model="deleteEmployeeDialog" max-width="400px">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>Eliminar empleado</v-card-title>
                <v-card-text style="padding-top: 2em;">
                    <p>Desea eliminar el empleado {{ employee.name }} {{ employee.last_name }}?</p>
                    <p>Recuerde que esta acción no se puede deshacer</p>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn color="blue darken-1" text @click="deleteEmployeeDialog = false">Cancelar</v-btn>
                    <form @submit.prevent="destroyEmployee(employee)">
                        <v-btn color="red darken-1" text type="submit">Eliminar</v-btn>
                    </form>
                </v-card-actions>
            </v-card>
        </v-dialog>
    <v-dialog v-model="newEmployeeForm" persistent max-width="600px">
        <v-card>
            <form @submit.prevent="createEmployee">
            <v-card-title>
                <span class="headline">Agregar empleado</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-text-field label="* Nombre" id="name" v-model="employee.name" required></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-text-field label="* Apellidos" id="last_name" v-model="employee.last_name" required></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field label="* Email" id="email" v-model="employee.email" required></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-text-field label="* Documento" id="document" v-model="employee.document" required></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-text-field label="* Salario" id="salary" v-model="employee.salary" required></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-text-field label="Cargo" id="position" v-model="employee.position"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-text-field label="Área" id="area" v-model="employee.area"></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                <small>* campos obligatorios</small>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn color="red darken-1" text @click="newEmployeeForm = false">Cancelar</v-btn>
                <v-btn color="green darken-1" text type="submit">Guardar</v-btn>
            </v-card-actions>
            </form>
        </v-card>
    </v-dialog>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                employee: {
                    name: '',
                    last_name: '',
                    document: '',
                    email: '',
                    position: '',
                    area: '',
                    salary: ''
                },
                employees: [],
                showDetail: false,
                newEmployeeForm: false,
                editEmployeeForm: false,
                deleteEmployeeDialog: false,
                errorAlert: false,
                errorMessage: '',
                errors: [],
                indexDelete: 0,
                search: '',
                headers: [
                    { text: 'Empleado', value: 'name', },
                    { text: 'Correo', value: 'email' },
                    { text: 'Cargo', value: 'position' },
                    { text: 'Área', value: 'area' },
                    { text: 'Acciones' },
                ],
            }
        },
        created(){
            axios.get('/api/get_employees')
            .then(res => {
                this.employees = res.data;
            })
        },
        methods:{
            showEmployee(item){
                this.showDetail = true;
                this.employee = item;
            },
            addEmployee(item){
                this.employees.push(item);
            },
            editEmployee(item){
                this.editEmployeeForm = true;
                this.employee = item;
            },
            updateEmployee(){
                if(this.employee.name.trim() === '' || this.employee.last_name.trim() === '' || this.employee.document.trim() === '' || this.employee.email.trim() === '' || this.employee.position.trim() === '' || this.employee.area.trim() === ''){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(re.test(email)){
                    alert('Hola');
                }
                alert('Hola');
                this.formValidation();
                const updatedEmployee = this.employee;
                axios.put('/api/update_employee', updatedEmployee).then((res) =>{
                    this.editEmployeeForm = false;
                    console.log(res);
                })
                .catch(err =>{
                    console.log(err);
                })
            },
            deleteEmployee(item, index){
                this.deleteEmployeeDialog = true;
                this.employee = item;
                this.indexDelete = index;
            },
            destroyEmployee(item){
                const destroyedEmployee = this.employee;
                let url = '/api/destroy_employee/' + destroyedEmployee.id;
                axios.delete(url, destroyedEmployee).then((res) =>{
                    this.deleteEmployeeDialog = false;
                    this.employees.splice(this.indexDelete, 1);
                })
                .catch(err =>{
                    console.log(err);
                })
            },
            newEmployee(){
                this.employee = this.clearEmployee();
                this.newEmployeeForm = true;
            },
            createEmployee(){
                if(this.employee.name.trim() === '' || this.employee.last_name.trim() === '' || this.employee.document.trim() === '' || this.employee.email.trim() === '' || this.employee.position.trim() === '' || this.employee.area.trim() === '' || this.employee.salary.trim() === ''){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                axios.post('/api/store_employee', this.employee).then((res) =>{
                    // this.employee = this.clearEmployee();
                    console.log(res);
                    this.newEmployeeForm = false;
                    this.employees.push(this.employee);
                    this.employee = this.clearEmployee();
                })
                .catch((err) =>{
                    console.log(`Create Employee component error: ${err}`);
                });
            },
            clearEmployee(){
                return {
                    name: '',
                    last_name: '',
                    document: '',
                    email: '',
                    position: '',
                    area: '',
                    salary: ''
                };
            },
            formValidation(){
                if (!this.email) {
                    this.errors.push('Email required.');
                } else if (!this.validEmail(this.email)) {
                    this.errors.push('Valid email required.');
                }

                if (!this.errors.length) {
                    // return true;
                    this.showErrorAlert('Valid email required.');
                }
            },
            validEmail(email){
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            showErrorAlert(msg){
                this.errorAlert = true;
                this.errorMessage = msg;
            }
        }
    }
</script>