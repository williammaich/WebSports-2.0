<template>
<div>

  <vue-calendar :events="reservas" locale="en" @eventClick="handleClick($event)">
  </vue-calendar>
  <div class="reserva" v-show="viewReserva">
    <div class="reserva__header">
      <span class="reserva__title">Edição de Reserva</span>
      <span class="ti-close reserva__close" @click.stop="viewReserva = false"></span>
    </div>
    <div class="reserva__body">
      <div class="reserva__input-group">
        <label for="">NOME</label>        
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" :value="reserva.cliente.nome">
      </div>
      <div class="reserva__input-group">
        <label for="">E-MAIL</label>
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" :value="reserva.cliente.email">
      </div>
      <div class="reserva__input-group">
        <label for="">CPF</label>
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" :value="reserva.cliente.cpf">
      </div>
      <div class="reserva__input-group">
        <label for="">SALDO</label>        
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" :value="reserva.cliente.saldo">
      </div>
      <div class="reserva__input-group">
        <label for="">RESERVADO PARA</label>
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" :value="reserva.dataReservada">
      </div>
      <div class="reserva__input-group">
        <label for="">CRIADO EM</label>
        <input type="text" readonly @keydown.enter="addReadonly($event)" @dblclick="edit($event)" :value="reserva.created_at">
      </div>
    </div>
  </div>
</div>
</template>

<script>
import VueCalendar from "../../UIComponents/FullCalendar/src";

export default {
  created() {
    this.$store.dispatch("load-reservas");
  },
  data() {
    return {
      viewReserva: false,
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

      return event;
    }
  },

  components: {
    VueCalendar
  },
  methods: {
    async handleClick(e) {
      console.log(e);
      this.viewReserva = true;
      let reserva;
      await this.$store.dispatch("load-reserva", e.id).then(res => {
        reserva = this.$store.state.reserva;
      });
      this.reserva = reserva;
    },
    edit(e) {
      e.target.removeAttribute("readonly");
    },
    addReadonly(e) {
      e.target.setAttribute("readonly", true);
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
  display: flex;
  flex-direction: column;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80vw;
  z-index: 9000;
  background: rgba(255, 255, 255, 0.97);
  padding: 30px;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  &__header {
    width: 100%;
    display: flex;
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
    flex-direction: row;
    align-items: baseline;

    label {
      flex-basis: 20vw;
      text-align: right;
    }
    input {
      text-align: left;
      padding-left: 10px;
      color: #444;
      font-weight: 400;
    }
  }
}
</style>
