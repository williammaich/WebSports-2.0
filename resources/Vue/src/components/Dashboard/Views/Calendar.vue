<template>
<div>

  <vue-calendar :events="reservas" locale="en" @eventClick="handleClick($event)">
  </vue-calendar>
  <div class="reserva" :class="reserva_class">
    <div class="reserva__header">
      <div class="reserva--column">
        <span class="reserva__title">Edição de Reserva</span>
        <span class="reserva__subtitle">Dê dois cliques no campo para editar e enter para salvar</span>
      </div>
      <span class="ti-close reserva__close" @click.stop="reserva_class = 'reserva--closed'"></span>
    </div>
    <div class="reserva__body">
      <div class="reserva__input-group">
        <label for="">NOME</label>
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" v-model="reserva.cliente.nome">
      </div>
      <div class="reserva__input-group">
        <label for="">E-MAIL</label>
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" v-model="reserva.cliente.email">
      </div>
      <div class="reserva__input-group">
        <label for="">CPF</label>
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" v-mask="['###.###.###-##']" v-model="reserva.cliente.cpf">
      </div>
      <div class="reserva__input-group">
        <label for="">SALDO</label>
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" v-mask="['R$ ###,00']" v-model="reserva.cliente.saldo">
      </div>
      <div class="reserva__input-group">
        <label for="">RESERVADO PARA</label>
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" v-model="reserva.dataReservada">
      </div>
      <div class="reserva__input-group">
        <label for="">CRIADO EM</label>
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" v-model="reserva.created_at">
      </div>
    </div>
  </div>
</div>
</template>

<script>
import VueCalendar from "../../UIComponents/FullCalendar/src";
import {mask} from 'vue-the-mask'
import DatePicker from 'vuejs-datepicker'
export default {
  created() {
    this.$store.dispatch("load-reservas");
  },
  data() {
    return {
      id: 0,
      reserva_class: '',
      reserva: {
        cliente: {
          cpf: "",
          email: "",
          nome: "",
          saldo: ""
        },
        dataReservada: "",
        created_at: "",
        updated_at: ""
      }
    };
  },

  computed: {
    reservas() {
      let data = this.$store.state.reservas;
      let event = [];
      data.forEach(function(element) {
        let timeArray = element["dia"].split("/");
        let time = `${timeArray[2].substring(
          0,
          4
        )}-${timeArray[1]}-${timeArray[0]}`;
        let hour = `${element["dia"].substring(11, 16)}`;
        let end = new Date();
        end.setHours(hour.substring(0, 2));
        end.setMinutes(hour.substring(3, 5));
        end.setTime(end.getTime() + element["reservas"] * 60 * 60 * 1000);

        event.push({
          id: element.id,
          title: `${hour} ${element["nome do cliente"]}`,
          start: `${time} ${hour}`,
          end: `${time} ${end.toLocaleTimeString()}`
        });
      });
      this.$Progress.finish()
      return event;
    }
  },
  directives: {
    mask
  },
  components: {
    VueCalendar,
    DatePicker
  },
  methods: {
    async handleClick(e) {
      this.id = e.id
      this.$Progress.start()
      console.log(e);
      let reserva;
      await this.$http.get(`http://localhost:8000/api/reservas/${e.id}`).then(res => {
        console.log(res.body)
        reserva = res.body;
      });
      this.reserva = reserva;
      this.$Progress.finish()
      this.reserva_class = 'reserva--active'

    },
    edit(e) {
      e.target.removeAttribute("readonly");
    },
    async addReadonly(e) {
      console.log(e)
      this.reserva.cliente.cpf = this.reserva.cliente.cpf.replace(/[^a-zA-Z0-9 ]/g, "")
      this.reserva.cliente.saldo = this.reserva.cliente.saldo.replace(/[^0-9 ]/g, "")
      await this.$http.put(`http://localhost:8000/api/reservas/${this.id}`, this.reserva)
      e.target.setAttribute("readonly", true);
      this.$store.dispatch("load-reservas");

    }
  }
};
</script>

<style lang="scss">
.comp-full-calendar {
  width: 100%;
}

.reserva {
  position: fixed;
  height: 100vh;
  right: 0;
  top: 0;
  transform: translateX(35vw);
  display: flex;
  flex-direction: column;
  width: 35vw;
  z-index: 9000;
  background: rgba(255, 255, 255, 0.97);
  padding: 30px;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  &--closed {
    animation: translateX-reverse .4s forwards;
  }
  &--active {
    animation: translateX .4s forwards;
  }
  &--column {display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%
  }
  &__header {
    width: 100%;
    display: flex;
    margin-bottom: 40px;
    justify-content: space-between;
  }
  &__title {
    margin: 0 auto;
    font-size: 1.8em;
  }
  &__close {
    cursor: pointer;
    padding: 4px;
    font-size: 1.8em;
  }
  &__input-group {
    display: flex;
    flex-direction: column;
    align-items: baseline;
    border-bottom: 1px solid rgba(50,50,50,.1);
    margin-bottom: 10px;
    label {
      text-align: right;
      margin-right: 20px;
    }
    input {
      text-align: left;
      padding-left: 0;
      color: #444;
      font-weight: 400;
      cursor: pointer;
    }
  }
}

@keyframes translateX {
    0% {
      transform: translateX(35vw);
    }
    100% {
      transform: translateX(0);
    }
}
@keyframes translateX-reverse {
  0% {
    transform:  translateX(0);
  }
    100% {
      transform:  translateX(35vw);
    }
}
</style>
