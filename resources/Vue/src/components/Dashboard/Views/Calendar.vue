<template>
    <div>
    
        <vue-calendar :events="reservas" locale="en"></vue-calendar>
    
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

        event.push({    
          title: `${hour} ${element["nome do cliente"]}`,
          start: `${time} ${hour}`,
          end: `${time} ${hour}`
        });
        console.log(event);
        
      });

      return event;
    }
  },

  components: {
    VueCalendar
  }
};
</script>

<style>
.comp-full-calendar {
  width: 100%;
}
</style>
