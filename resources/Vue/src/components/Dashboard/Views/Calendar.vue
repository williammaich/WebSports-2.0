<template>
  <div>
      <vue-calendar :events="[]" locale="en"></vue-calendar>
  </div>
</template>

<script>
import VueCalendar from '../../UIComponents/FullCalendar/src'
export default {
    components: {
        VueCalendar
    }
}
</script>

<style>
    .comp-full-calendar {
        width: 100%;
    }
</style>
