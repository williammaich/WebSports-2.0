<template>
  <div class="row">

    <div class="col-md-12">
      <div class="card card-plain">
        <paper-table type="hover" :title="table.title" :sub-title="table.subTitle" :data="table.data"
                     :columns="table.columns">

        </paper-table>
      </div>
    </div>

  </div>
</template>
<script>
  import PaperTable from 'components/UIComponents/PaperTable.vue'

  const tableColumns = ['Id', 'Nome do Cliente', 'Endereço', 'CPF', 'Telefone']
  const tableData = [{
    'id': 1,
    'nome do cliente': 'Miguel Boanova',
    'endereço': 'Rua Dr João Pessoa, 799 APT 201B',
    'cpf': '038.121.140-11',
    'telefone': '(53) 9 9179-0710'
    },
    {
      'id': 2,
      'nome do cliente': 'Joãozinho Da Quebrada',
      'endereço': 'Rua da quebrada, 1022, Bloco 3',
      'cpf': '027.144.121-11',
      'telefone': '(53) 9 9122-0123'
    },
    {
      'id': 3,
      'nome do cliente': 'Jon Snow | Aegon Targeryan',
      'endereço': 'Winterfell, 825, Castelo 4',
      'cpf': '034.133.121-11',
      'telefone': '(53) 9 8234-0221'
    },
    {
      'id': 4,
      'nome do cliente': 'Cersei Lannister',
      'endereço': 'Rochedo Casterly, 799 Castelo Lannister',
      'cpf': '111.423.425-11',
      'telefone': '(11) 9 9999-2345'
    },
    {
      'id': 5,
      'nome do cliente': 'Jaime Lannister',
      'endereço': 'Rochedo Casterly, 799 Castelo Lannister',
      'cpf': '122.423.425-11',
      'telefone': '(11) 9 9933-2345'
    },
    {
      'id': 6,
      'nome do cliente': 'Sonsa Stark',
      'endereço': 'Winterfell, 825, Castelo 4',
      'cpf': '024.177.124-11',
      'telefone': '(53) 9 8221-0421'
    },
    {
      'id': 7,
      'nome do cliente': 'Daenerys Targeryan',
      'endereço': 'Dona da Porra Toda das Cidades Livres',
      'cpf': '444.444.222-11',
      'telefone': '(53) 9 1111-7777'
    }]

  export default {
    components: {
      PaperTable
    },
    data() {
      return {
        table: {
          title: 'Listagem de Clientes',
          subTitle: 'Para qualquer alteração, clique duas vezes em cima do registro',
          columns: [...tableColumns],
          data: [...tableData]
        }
      }
    }
  }

</script>
<style>

</style>
