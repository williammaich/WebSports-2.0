<template>
    <div class="row">

      <div class="col-md-12">
        <div class="card card-plain">
          <paper-table type="hover" :title="table.title" :sub-title="table.subTitle" :sort="sort" :data="reservas" :columns="table.columns">

          </paper-table>
        </div>
      </div>

    </div>
</template>
<script>
  import PaperTable from 'components/UIComponents/PaperTable.vue'
  const tableColumns = ['Id', 'Nome do Cliente', 'Dia', 'Horario', 'Reservas']

  export default {
    created() {
      this.$store.dispatch('load-reservas')
    },
    components: {
      PaperTable
    },
    computed: {
      reservas() {
        return this.$store.state.reservas
      }
    },
    mounted() {
      console.log(this.reservas);
    },
    data () {
      return {
        sort: 'dia',
        table: {
          title: 'Listagem de Reservas',
          subTitle: 'Para qualquer alteração, clique duas vezes em cima do registro',
          columns: [...tableColumns]
        }
      }
    }
  }

</script>
<style>

</style>
