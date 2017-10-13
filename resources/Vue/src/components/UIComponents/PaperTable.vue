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
          <th v-for="column in columns" @click="setSort(column)">{{column}}</th>
        </thead>
        <tbody>
          <tr v-for="item in filtered">
            <td v-for="column in columns" v-if="hasValue(item, column)">{{itemValue(item, column)}}</td>
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
</style>
