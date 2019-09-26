<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
            <v-btn color="primary" dark v-on="on">Agregar empleado</v-btn>
        </template>
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
                <v-btn color="red darken-1" text @click="dialog = false">Cancelar</v-btn>
                <v-btn color="green darken-1" text type="submit">Guardar</v-btn>
            </v-card-actions>
            </form>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  export default {
    data(){
        return {
            dialog: false,
            employee: {
                name: '',
                last_name: '',
                document: '',
                email: '',
                position: '',
                area: '',
                salary: ''
            }
        }
    },
    methods:{
        createEmployee(){
            if(this.employee.name.trim() === '' || this.employee.last_name.trim() === '' || this.employee.document.trim() === '' || this.employee.email.trim() === '' || this.employee.position.trim() === '' || this.employee.area.trim() === '' || this.employee.salary.trim() === ''){
                alert('Debes completar todos los campos antes de guardar');
                return;
            }
            const newEmployee = this.employee;
            this.employee = {
                name: '',
                last_name: '',
                document: '',
                email: '',
                position: '',
                area: '',
                salary: 0
            };
            axios.post('/api/store_employee', this.newEmployee).then((res) =>{
                // const employeeSend = res.data;
                // this.$emit('add-employee', employeeSend);
                this.dialog = false;
            })
            .catch((err) =>{
                console.log(`Create Employee component error: ${err}`);
            });
        },
    }
  }
</script>