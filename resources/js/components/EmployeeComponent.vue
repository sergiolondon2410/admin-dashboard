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
                                    <v-tooltip right>
                                        <template v-slot:activator="{ on }">
                                            <v-btn text icon color="blue" v-on="on">
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Editar</span>
                                    </v-tooltip>
                                    <show-employee-component :visible="showEmployee" @close="showEmployee=false"></show-employee-component>
                                </td>
                            </tr>
                        </tbody>
                    </v-simple-table>
                    <v-card-actions>
                        <create-employee-component/>
                    </v-card-actions>
                </v-card>    
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
                employees: [],
                showEmployee: false,
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
            },
        }
    }
</script>