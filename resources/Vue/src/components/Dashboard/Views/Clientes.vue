<template>
<div class="row">

  <div class="col-md-12">
    <div class="card card-plain">
      <paper-table @update="handleUpdate"  type="hover" :title="table.title" :sub-title="table.subTitle" :data="clientes" :columns="table.columns">

      </paper-table>
    </div>
  </div>

</div>
</template>
<script>
import PaperTable from "components/UIComponents/PaperTable.vue";
const tableColumns = [{name: "Nome do Cliente"}, {name:"Endereço"},
 {name:"CPF", mask: ['###.###.###-##', '##.###.###/####-##']}, {name:"Saldo", mask: ['R$ ###,##']}];

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
      if (payload.data.column == "Endereço") {
        payload.data.rua = payload.data.value.split(",")[0];
        payload.data.numero = payload.data.value.split(",")[1].trim();
        payload.data.complemento =
          payload.data.value.split(",")[2].trim() || "";
      }

      this.$store.dispatch("update-clientes", payload.data);
      this.$store.dispatch("load-clientes");
    },
    handleCreate(payload) {
      //       let data = {
      //   name: payload["Nome do Usuario"],
      //   email: payload["Email"],
      //   password: payload["Senha"]
      // }
      // this.$store.dispatch("create-users", data)
      // this.$store.dispatch("load-users");
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
        columns: [...tableColumns]
      }
    };
  }
};
</script>
<style>

</style>
