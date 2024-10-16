<template>
  <div class="chart-container">
    <div ref="chart"></div>
  </div>
</template>
  
  <script>
import Highcharts from 'highcharts'

export default {
  name: 'Chart',
  props: {
    chartOptions: {
      type: Object,
      required: true,
    },
  },
  mounted() {
    this.renderChart()
  },
  methods: {
    renderChart() {
      this.chart = new Highcharts.Chart(this.$refs.chart, this.chartOptions)
    },
  },
  watch: {
    chartOptions: {
      deep: true,
      handler(newOptions) {
        if (this.chart) {
          this.chart.destroy()
          this.renderChart()
        }
      },
    },
  },
  beforeDestroy() {
    if (this.chart) {
      this.chart.destroy()
    }
  },
}
</script>
  
  <style scoped>
.chart-container {
  width: 100%;
}
</style>
  