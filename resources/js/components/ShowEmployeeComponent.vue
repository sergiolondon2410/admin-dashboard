
<template>
    <v-dialog :value="value" @input="$emit('input')">
      <v-card>         
        <v-btn color="red" @click.native="$emit('input')">Close</v-btn>
      </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
      valor: {
        type: String,
        default: "nada"
      },
    },
    data(){
        return {
            dialog: false
        }
    },
    created(){
        console.log(this.valor)
    },
}
</script>