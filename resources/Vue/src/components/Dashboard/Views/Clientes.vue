<template>
<div class="row">

  <div class="col-md-12">
    <div class="card card-plain">
      <paper-table @createSubmit="handleCreate" @update="handleUpdate"  type="hover" :title="table.title" :sub-title="table.subTitle" :data="clientes" :columns="table.columns">

      </paper-table>
    </div>
  </div>

</div>
</template>
<script>
import PaperTable from "components/UIComponents/PaperTable.vue";
const tableColumns = [{name: "Nome do Cliente"}, {name: 'Email', type:'email'}, {name:"Endereço"},
 {name:"CPF", mask: '###.###.###-##'}, {name:"Saldo", mask: 'R$ ###,##'}];

export default {
  created() {
    // this.$Progress.start()
    this.$store.dispatch("load-clientes");
  },
  components: {
    PaperTable
  },

  computed: {
    clientes() {
      return this.$store.state.clientes;
    }
  },
  methods: {
    handleUpdate(payload) {
      payload.data.column = payload.data.column.replace(
        "Nome do Cliente",
        "nome"
      );
      console.log(payload.data);
      let data;
      if (payload.data.column == "Endereço") {
        payload.data.rua = payload.data.value.split(",")[0];
        payload.data.numero = payload.data.value.split(",")[1].trim();
        payload.data.complemento =
        payload.data.value.split(",")[2].trim() || "";
        data = {
          endereco : {
            rua: payload.data.rua,
            numero : payload.data.numero,
            complemento: payload.data.complemento
          }
        }
      } else {
        data = {
          [payload.data.column.toLowerCase()] : payload.data.value
        }
      }
      console.log(data)

      this.$http.put('http://localhost:8000/api/clientes/' + payload.data.id, data).then((response) => {console.log('response', response);})
      this.$store.dispatch("load-clientes");
    },
    handleCreate(payload) {
      let data = {
        nome: payload['Nome do cliente'],
        email: payload['Email'],
        endereco : {
          rua: payload['Endereço'].split(",")[0],
          numero : payload['Endereço'].split(",")[1] || '',
          complemento: payload['Endereço'].split(",")[2] || ''
        },
        cpf: payload['CPF'],
        saldo: payload['Saldo']
      }

      this.$http.post('http://localhost:8000/api/clientes', data)

      this.$store.dispatch("load-clientes");

    }
  },
  mounted() {
    console.log(this.clientes);
  },
  data() {
    return {
      table: {
        title: "Listagem de Clientes",
        subTitle:
          "Para qualquer alteração, clique duas vezes em cima do registro",
        columns: [tableColumns]
      }
    };
  }
};
</script>
<style>

</style>
