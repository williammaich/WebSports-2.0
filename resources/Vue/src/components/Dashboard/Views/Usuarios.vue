<template>
<div class="row">

  <div class="col-md-12">
    <div class="card card-plain">
      <paper-table @createSubmit="handleCreate" @update="handleUpdate" type="hover" :title="table.title" :sub-title="table.subTitle" :data="users" :columns="table.columns">

      </paper-table>
    </div>
  </div>

</div>
</template>
<script>
import PaperTable from "components/UIComponents/PaperTable.vue";

const tableColumns = [
  {name:"Nome do Usuario"}, 
  {name:"Email"}, 
  {name:"Senha"}];

export default {
  created() {
    // this.$Progress.start()
    this.$store.dispatch("load-users");
  },
  components: {
    PaperTable
  },
  computed: {
    users() {
      return this.$store.state.users;
    }
  },
  mounted() {
    console.log(this.users);

  },
  methods: {
    handleUpdate(payload) {
      payload.data.column = payload.data.column.replace('Nome do Usuario', 'name');
      payload.data.column = payload.data.column.replace('Id', 'id');
      payload.data.column = payload.data.column.replace('Email', 'email');
      payload.data.column = payload.data.column.replace('Senha', 'password');
      console.log(payload.data);
      this.$store.dispatch("update-user", payload.data)

      this.$store.dispatch("load-users");
    },
    handleCreate(payload) {
      let data = {
        name: payload["Nome do Usuario"],
        email: payload["Email"],
        password: payload["Senha"]
      }
      this.$store.dispatch("create-users", data)
      this.$store.dispatch("load-users");
    }
  },
  data() {
    return {
      sort: "Id",
      table: {
        title: "Listagem de Usuários",
        subTitle: "Para qualquer alteração, clique duas vezes em cima do registro",
        columns: [...tableColumns]
      }
    };
  }
};
</script>
<style>

</style>
