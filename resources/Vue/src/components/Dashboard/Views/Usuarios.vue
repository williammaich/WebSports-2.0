<template>
  <div class="row">

    <div class="col-md-12">
      <div class="card card-plain">
        <paper-table type="hover" :title="table.title" :sub-title="table.subTitle" :data="users"
                     :columns="table.columns">

        </paper-table>
      </div>
    </div>

  </div>
</template>
<script>
  import PaperTable from 'components/UIComponents/PaperTable.vue'

  const tableColumns = ['Id', 'Nome do Usuario', 'Email', 'Senha']

export default {
 
   created() {
      this.$store.dispatch('load-users')
    },
    components: {
      PaperTable
    },
    computed: {
      users() {
        return this.$store.state.users
      }
    },
    mounted() {
      console.log(this.users);
    },
    data () {
      return {
        sort: 'Id',
        table: {
          title: 'Listagem de Usuários',
          subTitle: 'Para qualquer alteração, clique duas vezes em cima do registro',
          columns: [...tableColumns]
        }
      }
    }
  }

</script>
<style>

</style>
