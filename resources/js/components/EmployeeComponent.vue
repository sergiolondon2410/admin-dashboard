

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Agregar empleado</h3>
                
                    <form @submit.prevent="addEmployee">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" placeholder="Nombre" class="form-control mb-2" v-model="employee.name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" placeholder="Apellidos" class="form-control mb-2" v-model="employee.last_name">
                                </div>
                            </div>
                        <div class="w-100"></div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" placeholder="Email" class="form-control mb-2" v-model="employee.email">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" placeholder="Documento" class="form-control mb-2" v-model="employee.document">
                                </div>
                            </div>
                        <div class="w-100"></div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" placeholder="Cargo" class="form-control mb-2"  v-model="employee.position">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" placeholder="Área" class="form-control mb-2" v-model="employee.area">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" placeholder="Salario Mensual" class="form-control mb-2" v-model="employee.salary">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Agregar</button>
                    </form>
                
                <hr>
                <h3>Listado de empleados</h3>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Empleado</th>
                            <th>Documento</th>
                            <th>Salario</th>
                            <th>Cargo</th>
                            <th>Área</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in employees" :key="item.id">
                            <td>{{ item.name }} {{ item.last_name }}</td>
                            <td>{{ item.document }}</td>
                            <td>{{ item.salary }}</td>
                            <td>{{ item.position }}</td>
                            <td>{{ item.area }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
                employees: []
            }
        },
        created(){
            axios.get('/api/get_employees')
            .then(res => {
                this.employees = res.data;
            })
        },
        methods:{
            addEmployee(){
                if(this.employee.name.trim() === '' || this.employee.last_name.trim() === '' || this.employee.document.trim() === '' || this.employee.email.trim() === '' || this.employee.position.trim() === '' || this.employee.area.trim() === '' || this.employee.salary.trim() === ''){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const newEmployee = this.employee;
                console.log(newEmployee);
                this.employee = {
                    name: '',
                    last_name: '',
                    document: '',
                    email: '',
                    position: '',
                    area: '',
                    salary: ''
                };    
                axios.post('/api/store_employee', newEmployee).then((res) =>{
                    const employeeSend = res.data;
                    this.employees.push(employeeSend);
                })
            },
        }
    }
</script>