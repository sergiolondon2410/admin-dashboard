<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <v-card class="mx-auto">
                    <v-card-title>Listado de empleados</v-card-title>
                    <v-simple-table>
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Documento</th>
                                <th>Salario</th>
                                <th>Cargo</th>
                                <th>Área</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in employees" :key="item.id">
                                <td class="text-left">{{ item.name }} {{ item.last_name }}</td>
                                <td class="text-left">{{ item.document }}</td>
                                <td class="text-left">{{ item.salary }}</td>
                                <td class="text-left">{{ item.position }}</td>
                                <td class="text-left">{{ item.area }}</td>
                                <td class="text-left">
                                    <v-btn text icon @click="showEmployee(item)" color="green"><v-icon>mdi-eye</v-icon></v-btn>
                                    <v-btn text icon @click="editEmployee(item)" color="blue"><v-icon>mdi-pencil</v-icon></v-btn>
                                </td>
                            </tr>
                        </tbody>
                    </v-simple-table>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <create-employee-component/>
                    </v-card-actions>
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
                newEmployee: false,
                editEmployeeForm: false,
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
            updateEmployee(item){
                if(this.employee.name.trim() === '' || this.employee.last_name.trim() === '' || this.employee.document.trim() === '' || this.employee.email.trim() === '' || this.employee.position.trim() === '' || this.employee.area.trim() === ''){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                console.log(this.employee.name);
                const updatedEmployee = this.employee;
                this.employee = {
                    name: '',
                    last_name: '',
                    document: '',
                    email: '',
                    position: '',
                    area: '',
                    salary: ''
                };    
                axios.put('/api/update_employee', updatedEmployee).then((res) =>{
                    this.employees = this.employees.map(employee => (employee.id === id ? res.data : employee));
                    this.editEmployeeForm = false;
                })
            },
        }
    }
</script>