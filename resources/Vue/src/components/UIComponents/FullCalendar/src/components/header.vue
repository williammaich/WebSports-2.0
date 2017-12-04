<template>
<div class="full-calendar-header">

  <div class="month">
    <span class="title">{{title.split(' ')[0]}}</span>
    <span class="titleYear">{{title.split(' ')[1]}}</span>
  </div>
  <div class="arrows">
    <span class="prev-month" @click.stop="goPrev">{{leftArrow}}</span>
    <span class="next-month" @click.stop="goNext">{{rightArrow}}</span>
  </div>

</div>
</template>

<script type="text/babel">
import dateFunc from "./dateFunc";

export default {
  created() {
    this.dispatchEvent();
  },
  props: {
    currentDate: {},
    titleFormat: {},
    firstDay: {},
    monthNames: {}
  },
  data() {
    return {
      title: "",
      leftArrow: "<",
      rightArrow: ">",
      headDate: new Date()
    };
  },
  watch: {
    currentDate(val) {
      if (!val) return;
      this.headDate = val;
      // this.headDate = JSON.parse(JSON.stringify(val))
    }
  },
  methods: {
    goPrev() {
      this.headDate = this.changeMonth(this.headDate, -1);
      this.dispatchEvent();
    },
    goNext() {
      this.headDate = this.changeMonth(this.headDate, 1);
      this.dispatchEvent();
    },
    changeMonth(date, num) {
      let dt = new Date(date);
      return new Date(dt.setMonth(dt.getMonth() + num));
    },
    dispatchEvent() {
      this.title = dateFunc.format(
        this.headDate,
        this.titleFormat,
        this.monthNames
      );

      let startDate = dateFunc.getStartDate(this.headDate);
      let curWeekDay = startDate.getDay();

      // 1st day of this monthView
      let diff = parseInt(this.firstDay) - curWeekDay;
      if (diff) diff -= 7;
      startDate.setDate(startDate.getDate() + diff);

      // the month view is 6*7
      let endDate = dateFunc.changeDay(startDate, 41);

      // 1st day of current month
      let currentDate = dateFunc.getStartDate(this.headDate);

      this.$emit(
        "change",
        dateFunc.format(startDate, "yyyy-MM-dd"),
        dateFunc.format(endDate, "yyyy-MM-dd"),
        dateFunc.format(currentDate, "yyyy-MM-dd"),
        this.headDate
      );
    }
  }
};
</script>

<style lang="scss">
.full-calendar-header {
  display: flex;
  height: 40vh;
  background: url("http://images.all-free-download.com/images/graphiclarge/twilight_on_the_sunshine_coast_514662.jpg") center center no-repeat;
  background-size: cover;
  position: relative;
  text-align: center;
  color: #fff;
  font-size: 60px;
  font-weight: 100;
  .month {
    display: inline-flex;
    padding: 20px 30px;
    justify-content: space-between;
    height: 100px;
    position: absolute;
    width: 100%
  }
  .arrows {
    margin: auto 0 0 auto;
    // padding: 0 30px;
    display: block;
  }
  .prev-month,
  .next-month {
    cursor: pointer;
    display: inline-block;
    margin-bottom: 10px;
    padding: 10px 30px;
    // width: 50px;
    // height: 50px;
    position: relative;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    transition: 0.5s;
    user-select: none;
    &:hover {
      transform: scale(1.3);
    }
  }
}
</style>
