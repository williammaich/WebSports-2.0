<template>
<div>
  <div class="header">
    <slot name="header">
      <h4 class="title">{{title}}</h4>
      <p class="category">{{subTitle}}</p>
      <span @click="create" class="ti-plus"></span>
    </slot>
  </div>
  <div class="content table-responsive table-full-width">
    <table class="table" :class="tableClass">
      <tr :class="classCreate">
        <td v-for="column in columns[0]" @keypress.enter="createSubmit($event)" :key="column.id">
            <v-select v-if="column.type == 'select'" v-model="clientSelected" :options="subData"></v-select>
            <input required v-mask="column.mask" :data-column="column.name" :type="column.type" v-else-if="column.mask" :placeholder="column.name" />
            <input required :data-column="column.name" :type="column.type" v-else :placeholder="column.name" />
        </td>
      </tr>
    </table>
    <table class="table" :class="tableClass">
      <thead>
        <th v-for="column in columns[0]" @click="setSort(column.name)" :key="column.id">{{column.name}} <span :class="sortOrder ? 'ti-arrow-up' : 'ti-arrow-down'"></span> </th>
        <th> Ações </th>
      </thead>
      <tbody>
        <tr v-for="item in filtered" :key="item.id" :id="item.id">
          <td v-for="column in columns[0]" v-if="hasValue(item, column.name)" :key="column.id">
            <input :type="column.type" v-if="column.mask" v-mask="column.mask" readonly="true" @keydown.enter="addReadonly($event, column.name)" @dblclick="edit($event)" :value="itemValue(item, column.name)">
            <input :type="column.type" v-else readonly="true" @keydown.enter="addReadonly($event, column.name)" @dblclick="edit($event)" :value="itemValue(item, column.name)">
          </td>
          <td>
            <span @click="view" :id="itemValue(item, 'id')" class="ti-info control view"></span>
            <span @click="remove" :id="itemValue(item, 'id')" class="ti-close control remove"></span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>
<script>
function delay(t) {
  return new Promise(function(resolve) {
    setTimeout(resolve, t);
  });
}
import {
  mask
} from "vue-the-mask";
import flatpickr from 'flatpickr'
import vSelect from 'vue-select'


export default {
  data() {
    return {
      toggleCreate: false,
      classCreate: "table-create",
      sortTable: 'id',
      sortOrder: true
    };
  },
  directives: {
    mask
  },
  components: {
    vSelect
  },
  props: {
    columns: Array,
    data: Array,
    subData: Array,
    sort: {
      type: String,
      default: "id"
    },
    type: {
      type: String, // striped | hover
      default: "Striped"
    },
    title: {
      type: String,
      default: ""
    },
    subTitle: {
      type: String,
      default: ""
    }
  },
  mounted() {
    delay(1000).then(() => {
      this.$Progress.finish();
    });
  },
  computed: {
    tableClass() {
      return `table-${this.type}`;
    },
    filtered() {
      let data = this.data;
      let sortTable = this.sortTable;
      let sortOrder = this.sortOrder;
      return _.orderBy(data, sortTable, sortOrder ? 'asc' : 'desc');
    }
  },
  methods: {
    edit(e) {
      e.target.removeAttribute("readonly");
    },
    addReadonly(e, column) {
      // e.path retorna um array com todos elementos do input até o o document
      // console.dir(e.path[2].id) = tr.id
      let data = {
        id: e.target.parentNode.offsetParent.id || e.path[2].id,
        value: e.target.value,
        column: column
      };
      this.$emit("update", {
        data
      });
      e.target.setAttribute("readonly", "true");
    },
    create(e) {
      this.classCreate = this.toggleCreate ?
        "table-create closed" :
        "table-create opened";
      this.toggleCreate = !this.toggleCreate;
      this.$emit("create", e);
    },
    view(e) {

    },
    remove(e) {
     this.$emit('delete', e)
    },
    createSubmit(e) {
      this.classCreate = "table-create closed";
      this.toggleCreate = false;
      let children = e.target.offsetParent.closest("tr").childNodes;
      let data = {};
      children.forEach(function(element) {
        data[element.firstChild.attributes["data-column"].value] =
          element.firstChild.value;
      });
      this.$emit("createSubmit", data);
    },
    hasValue(item, column) {
      return item[column.toLowerCase()] !== "undefined";
    },
    itemValue(item, column) {
      return item[column.toLowerCase()];
    },
    setSort(value) {
      this.sortTable = value.toLowerCase()
      this.sortOrder = !this.sortOrder
    }
  }
};
</script>
<style lang="scss">
th {
    text-align: center;
}
.control {
  cursor: pointer;
  padding: 5px 10px;
}
input,
select {
    width: 95%;
    padding: 10px;
}

input::-webkit-input-placeholder,
select {
    color: #bbb;
}

input::placeholder,
select {
    color: #bbb;
}

input:read-only {
    background: transparent;
    border: none;
    text-align: center;
    &[type="number"] {
        -moz-appearance: textfield;
    }

    &::-webkit-inner-spin-button,
    &::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }
}

.table-create {
    background: #f5f5f5;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    height: 0;
    transform: 1s;
    visibility: hidden;
    display: none;

}
.v-select{
  border: none !important;
  color: none !important;
  background: none !important;
}
.table-create input[type=search] {
  background: #fff !important;
  border: none !important;
}

.table-create input {
    background: #fff;
    border: none;
}

.table-create.opened {
  display: table-row;
   animation: openCreate 0.3s forwards;
}

.table-create.closed {
  display: table-row;

    animation: closeCreate 0.3s forwards;
}

.ti-plus {
    border: 1px solid #000;
    font-size: 25px;
    border-radius: 50%;
    padding: 10px;
    position: absolute;
    right: 0;
    top: 15px;
    cursor: pointer;
}
header, th {
  font-family: Montserrat;
  font-weight: 700;
}
td {
  input {font-weight: 400;}
}

@keyframes openCreate {
    0% {
        height: 0;
        opacity: 0;
        visibility: hidden;
    }
    100% {
        height: 100px;
        opacity: 1;
        visibility: visible;
    }
}

@keyframes closeCreate {
    0% {
        height: 100px;
        opacity: 1;
        visibility: visible;
    }
    100% {
        height: 0;
        opacity: 0;
        visibility: hidden;
    }
}
</style>
