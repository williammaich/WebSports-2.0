<template>
<div class="row">

  <div class="col-md-12">
    <div class="card card-plain">
      <paper-table @update="handleUpdate" type="hover" :title="table.title" :sub-title="table.subTitle" :sort="sort" :data="reservas" :columns="table.columns">

      </paper-table>
    </div>
  </div>

</div>
</template>
<script>
import PaperTable from "components/UIComponents/PaperTable.vue"
const tableColumns = ["Nome do Cliente", "Dia", "Reservas"]

export default {
  created() {
    // this.$Progress.start()
    this.$store.dispatch("load-reservas")
  },
  components: {
    PaperTable
  },
  computed: {
    reservas() {
      return this.$store.state.reservas

    }
  },
  methods: {
    handleUpdate(payload) {
      payload.data.column = payload.data.column.replace(
        "Nome do Cliente",
        "nome"
      )
      payload.data.column = payload.data.column.replace("Dia", "dataReservada")
      payload.data.column = payload.data.column.replace(
        "Reservas",
        "numReservas"
      )
      console.log(payload.data)
      this.$store.dispatch("update-reserva", payload.data)
      this.$store.dispatch("load-reservas")
    },
    handleCreate(payload) {
    //   let data = {
    //     name: payload["Nome do Usuario"],
    //     email: payload["Email"],
    //     password: payload["Senha"]
    //   }
    //   this.$store.dispatch("create-users", data)
    //   this.$store.dispatch("load-users");
    }
  },
  mounted() {
    console.log(this.reservas)

  },
  data() {
    return {
      sort: "dia",
      table: {
        title: "Listagem de Reservas",
        subTitle: "Para qualquer alteração, clique duas vezes em cima do registro",
        columns: [...tableColumns]
      }
    }
  }
}
</script>
<style>

</style>
