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
        <td v-for="column in columns" @keypress.enter="createSubmit($event)" :key="column.id">
          <input 
            v-mask="column == 'CPF' ? ['###.###.###-##', '##.###.###/####-##'] : undefined || column == 'Dia' ? ['##/##/#### ##:##'] : undefined || column == 'Saldo' ? ['R$ ###,##'] : undefined   " 
            :data-column="column" 
            :type="column == 'Dia' ? 'datetime' :'text'" 
            :placeholder="column" />
          </td>
      </tr>
    </table>
    <table class="table" :class="tableClass">
      <thead>
        <th v-for="column in columns" @click="setSort(column)" :key="column.id">{{column}}</th>
      </thead>
      <tbody>
        <tr v-for="item in filtered" :key="item.id" :id="item.id">
          <td v-for="column in columns" v-if="hasValue(item, column)" :key="column.id">
            <input 
              :type="column == 'Dia' ? 'datetime' : 'text'" 
              v-mask="column == 'CPF' ? ['###.###.###-##', '##.###.###/####-##'] : undefined || column == 'Dia' ? ['##/##/#### ##:##'] : undefined || column == 'Saldo' ? ['R$ ###,##'] : undefined   " 
              readonly="true" 
              @keydown.enter="addReadonly($event, column)" 
              @dblclick="edit($event)" 
              :value="itemValue(item,column)">
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
import { mask } from "vue-the-mask";

export default {
  data() {
    return {
      toggleCreate: false,
      classCreate: "table-create",
    };
  },
  directives: {
    mask
  },
  props: {
    columns: Array,
    data: Array,
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
      return _.sortBy(this.data, this.sort);
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
      this.classCreate = this.toggleCreate
        ? "table-create closed"
        : "table-create opened";
      this.toggleCreate = !this.toggleCreate;
      this.$emit("create", e);
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
    sortBy: function(sortKey) {
      this.reverse = this.sortKey === sortKey ? !this.reverse : false;

      this.sortKey = sortKey;
    },
    hasValue(item, column) {
      return item[column.toLowerCase()] !== "undefined";
    },
    itemValue(item, column) {
      return item[column.toLowerCase()];
    },
    setSort(value) {
      this.sort = value.toLowerCase();
    }
  }
};
</script>
<style>
th {
  text-align: center;
}

input {
  width: 95%;
  padding: 10px;
}

input::-webkit-input-placeholder {
  color: #bbb;
}

input::placeholder {
  color: #bbb;
}

input:read-only {
  background: transparent;
  border: none;
  text-align: center;
}

.table-create {
  background: #f5f5f5;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  height: 0;
  transform: 1s;
  visibility: hidden;
}

.table-create input {
  background: #fff;
  border: none;
}

.table-create.opened {
  animation: openCreate 0.3s forwards;
}

.table-create.closed {
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
