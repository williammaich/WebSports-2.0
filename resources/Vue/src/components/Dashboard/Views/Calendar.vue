<template>
<div>

  <vue-calendar :events="reservas" locale="en" @eventClick="handleEvent($event)">
  </vue-calendar>

</div>
</template>

<script>
import VueCalendar from "../../UIComponents/FullCalendar/src";

export default {
  created() {
    this.$store.dispatch("load-reservas");
  },

  computed: {
    reservas() {
      let data = this.$store.state.reservas;
      let event = [];
      data.forEach(function(element) {
        let timeArray = element['dia'].split('/')
        let time = `${timeArray[2].substring(0,4)}-${timeArray[1]}-${timeArray[0]}`
        let hour = `${element['dia'].substring(11,16)}`
        let end = new Date();
        end.setHours(hour.substring(0, 2))
        end.setMinutes(hour.substring(3, 5))
        end.setTime(end.getTime() + element['reservas'] * 60 * 60 * 1000)



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
    handleEvent(e) {
      console.log(e)
    }
  }
};
</script>

<style>
.comp-full-calendar {
  width: 100%;
}
</style>
