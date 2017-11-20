<template>
  <div>
    <div class="header">
      <slot name="header">
        <h4 class="title">{{title}}</h4>
        <p class="category">{{subTitle}}</p>
      </slot>
    </div>
    <div class="content table-responsive table-full-width">
      <table class="table" :class="tableClass">
        <thead>
          <th v-for="column in columns" @click="setSort(column)" :key="column.id">{{column}}</th>
        </thead>
        <tbody>
          <tr v-for="item in filtered" :key="item.id" :id="item.id">
            <td v-for="column in columns" v-if="hasValue(item, column)"  :key="column.id"><input type="text" v-show="true" readonly="true" @keydown.enter="addReadonly($event, column)" @dblclick="edit($event)" :value="itemValue(item,column)"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
  export default {
    props: {
      columns: Array,
      data: Array,
      sort: {
        type: String,
        default: 'id'
      },
      type: {
        type: String, // striped | hover
        default: 'Striped'
      },
      title: {
        type: String,
        default: ''
      },
      subTitle: {
        type: String,
        default: ''

      }
    },
    computed: {
      tableClass () {
        return `table-${this.type}`
      },
      filtered () {
        return _.sortBy(this.data, this.sort)
      }
    },
    methods: {
      edit(e) {
       e.target.removeAttribute('readonly')
      },
      addReadonly(e, column){
        console.log(column)
        // e.path retorna um array com todos elementos do input até o o document
        // console.dir(e.path[2].id) = tr.id
        let data = {
          id: e.path[2].id, value: e.target.value, column : column
        }
        this.$emit('update', {data})
        e.target.setAttribute('readonly', 'true')
      },
      sortBy: function (sortKey) {
        this.reverse = (this.sortKey === sortKey) ? !this.reverse : false

        this.sortKey = sortKey
      },
      hasValue (item, column) {
        return item[column.toLowerCase()] !== 'undefined'
      },
      itemValue (item, column) {
        return item[column.toLowerCase()]
      },
      setSort (value) {
        this.sort = value.toLowerCase()
      }
    }
  }

</script>
<style>
 th {
   text-align: center;
 }

 input:read-only {
   background: transparent;
   border: none;
   text-align: center;
 }
</style>
