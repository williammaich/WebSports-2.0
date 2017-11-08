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
  const tableData = [{
    'id': 1,
    'nome do cliente': 'Miguel Boanova',
    'dia': '05/10/2017',
    'horario': '18:00',
    'reservas': '2'
  },
  {
    'id': 2,
    'nome do cliente': 'Roger Javiel',
    'dia': '10/10/2017',
    'horario': '14:00',
    'reservas': '1'
  },
  {
    'id': 3,
    'nome do cliente': 'Dionatan Melo',
    'dia': '11/10/2017',
    'horario': '15:00',
    'reservas': '3'
  },
  {
    'id': 4,
    'nome do cliente': 'Jon Snow',
    'dia': '28/10/2017',
    'horario': '10:00',
    'reservas': '2'
  },
  {
    'id': 5,
    'nome do cliente': 'William Maich',
    'dia': '22/10/2017',
    'horario': '12:00',
    'reservas': '1'
  }]



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
