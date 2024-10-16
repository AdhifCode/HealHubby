<template>
  <div class="container mx-auto pt-8">
    <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
    <div class="flex flex-wrap">
      <div v-for="(status, index) in statusItem" :key="index" class="flex-1">
        <div
          class="border rounded-lg p-4 mb-4 mr-4 shadow-md"
          style="width: 125px; height: 160px"
        >
          <div class="flex justify-center my-1">
            <button
              class="bg-blue-500 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-md"
            >
              <span class="text-xl">{{ status.icon }}</span>
            </button>
          </div>
          <div class="text-center text-blue-500">{{ status.Counts }}</div>
          <div class="text-center text-blue-500">{{ status.title }}</div>
        </div>
      </div>
      <div class="flex-1">
        <div
          v-for="(status, index) in statusItem"
          :key="index"
          class="card border border-gray-200 rounded-lg shadow-md mr-2 w-32 h-40"
        >
          <div class="flex justify-center my-1">
            <button
              class="bg-blue-500 text-white rounded-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <i class="text-xl">{{ status.icon }}</i>
            </button>
          </div>
          <div class="text-center">
            <h2 class="text-base text-gray-700">{{ status.Counts }}</h2>
            <h3 class="text-sm text-gray-700">{{ status.title }}</h3>
          </div>
        </div>

        <div
          class="flex mb-4 rounded-2xl bg-gray-100 p-4"
          style="height: 160px"
        >
          <div class="w-3/4">
            <div class="text-xl text-capitalize">
              {{ greeting }}, {{ profile.name }}
            </div>
            <div>Explore Dashboard Article</div>
            <div class="pt-4">
              <span class="font-light text-5xl">{{ todayDate }}</span>
            </div>
          </div>
          <img
            src="@/assets/img/schedule_img.png"
            alt="Schedule Image"
            class="w-48 mx-auto"
          />
        </div>
      </div>
    </div>
    <div class="flex">
      <div class="flex-1">
        <div class="bg-white rounded-lg p-4 mb-4">
          <div class="flex items-center">
            <div class="text-center flex-1">Activity</div>
            <div>
              <select
                v-model="selectedTimeRange"
                @change="setTimeRange"
                class="min-w-24 outline-none rounded-full px-4 py-1"
              >
                <option v-for="timeRange in timeRanges" :value="timeRange">
                  {{ timeRange }}
                </option>
              </select>
            </div>
          </div>
          <Chart :chartOptions="chartOptions" />
        </div>
      </div>
      <div class="flex-1">
        <div>
          <div class="text-xl font-bold mb-4">Top performers</div>
          <div
            v-for="(user, index) in top3"
            :key="index"
            class="flex items-center mb-4"
          >
            <div
              class="bg-gray-700 rounded-full w-16 h-16 flex items-center justify-center"
            >
              <img
                :src="
                  user.user_image
                    ? `http://127.0.0.1:8000/storage/${user.user_image}`
                    : require('@/assets/img/unknown.jpeg')
                "
                alt="User Image"
                class="rounded-full w-12 h-12"
              />
            </div>
            <div class="ml-4">
              <div class="font-bold text-xl text-blue-900">{{ user.name }}</div>
              <div class="text-gray-600">{{ user.email }}</div>
              <div class="text-gray-600">{{ user.total_favorites }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
  
  <script>
import axios from "axios";
import Chart from "@/components/Chart.vue";
import Highcharts from "highcharts";
import moment from "moment";

export default {
  components: {
    Chart,
  },
  layout: "Admin",
  middleware: ["authenticated", "admin"],

  data() {
    return {
      chartOptions: {
        chart: {
          height: 300,
          backgroundColor: "transparent",
        },
        title: {
          text: "",
        },
        xAxis: {
          type: "datetime",
          labels: {
            formatter: function () {
              return Highcharts.dateFormat("%Y", this.value);
            },
          },
          tickPositioner: function () {
            const data = this.chart.series[0].processedXData;
            const ticks = [];
            const dates = [];

            data.forEach((timestamp) => {
              const date = new Date(timestamp);
              const year = date.getFullYear();
              const month = date.getMonth();
              const day = date.getDate();
              const dateString = `${year}-${month}-${day}`;

              if (!dates.includes(dateString)) {
                dates.push(dateString);
                ticks.push(timestamp);
              }
            });

            return ticks;
          },
        },
        yAxis: {
          title: {
            text: false,
          },
        },
        legend: {
          enabled: false,
        },
        credits: {
          enabled: false,
        },
        series: [
          {
            name: "New User",
            data: [],
          },
        ],
      },
      loading: true,
      showMenu: false,
      fav: true,
      menu: false,
      message: false,
      hints: true,
      top3: {},
      originalData: [],
      statusItem: [],
      filteredData: [],
      selectedTimeRange: "Month",
      timeRanges: ["Month", "Year", "All Time"],
      greeting: "Good Morning",
      todayDate: moment().format("h:mm a"),
      profile: [],
    };
  },
  watch: {
    originalData: {
      handler() {
        this.$nextTick(() => {
          this.setTimeRange("Month");
        });
      },
      deep: true,
      immediate: true,
    },
  },
  methods: {
    getRoleCounts() {
      axios
        .get(`http://localhost:8000/api/user-role-counts`)
        .then((response) => {
          this.patientCount =
            response.data.role_counts.find((role) => role.role_id === 4)
              ?.count || 0;
          this.doctorCount =
            response.data.role_counts.find((role) => role.role_id === 3)
              ?.count || 0;

          this.statusItem = [
            {
              title: "Doctors",
              Counts: this.doctorCount,
              icon: "mdi-doctor",
              iconBackground: "#31C9A2",
            },
            {
              title: "Patients",
              Counts: this.patientCount,
              icon: "mdi-account-injury",
              iconBackground: "#FF6B82",
            },
            {
              title: "Consults",
              Counts: this.orderCount,
              icon: "mdi-information",
              iconBackground: "#9675F7",
            },
          ];

          console.log(this.orderCount);
        })
        .catch((error) => {
          console.error("Error fetching user role counts:", error);
        });
    },

    // Chart
    getPopularData() {
      axios
        .get(`http://localhost:8000/api/top3`)
        .then((response) => {
          console.log("API Response:", response);
          this.top3 = response.data?.top_rooms;
        })
        .catch((error) => {
          console.error("Error fetching user data:", error);
        });
    },
    getuser() {
      axios
        .get("http://127.0.0.1:8000/api/getuserchart")
        .then((response) => {
          const dataValues = response.data?.data;

          const formattedData = dataValues.map(([dateString, value]) => {
            const date = new Date(eval(dateString));
            return [date.getTime(), value];
          });

          formattedData.sort((a, b) => a[0] - b[0]);

          this.originalData = formattedData;
          this.filteredData = formattedData;

          this.chartOptions.series[0].data = this.filteredData;
        })
        .catch((error) => {
          console.error("Error fetching user data:", error);
        });
    },
    setTimeRange(range) {
      const now = new Date();
      const currentYear = now.getFullYear();
      const currentMonth = now.getMonth();

      switch (range) {
        case "Month":
          this.chartOptions.xAxis.labels.formatter = function () {
            const date = new Date(this.value);
            if (
              date.getFullYear() === currentYear &&
              date.getMonth() === currentMonth
            ) {
              return Highcharts.dateFormat("%e %b", this.value);
            } else {
              return "";
            }
          };
          this.filteredData = this.originalData.filter(([date, _]) => {
            const dataDate = new Date(date);
            return (
              dataDate.getFullYear() === currentYear &&
              dataDate.getMonth() === currentMonth
            );
          });
          break;
        case "Year":
          this.chartOptions.xAxis.labels.formatter = function () {
            const date = new Date(this.value);
            if (date.getFullYear() === currentYear) {
              return Highcharts.dateFormat("%b", this.value);
            } else {
              return "";
            }
          };
          const mergedData = [];
          const dataByMonth = {};

          this.originalData.forEach(([date, value]) => {
            const dataDate = new Date(eval(date));
            const year = dataDate.getFullYear();
            const month = dataDate.getMonth();
            const key = `${year}-${month}`;

            if (year === currentYear && dataByMonth[key]) {
              dataByMonth[key] += value;
            } else if (year === currentYear) {
              dataByMonth[key] = value;
            }
          });

          Object.entries(dataByMonth).forEach(([key, value]) => {
            const [year, month] = key.split("-");
            const date = Date.UTC(year, month, 1);
            mergedData.push([date, value]);
          });

          this.filteredData = mergedData;
          break;
        case "All Time":
          this.chartOptions.xAxis.labels.formatter = function () {
            return Highcharts.dateFormat("%Y", this.value);
          };
          const mergedDataAll = [];
          const dataByYear = {};

          this.originalData.forEach(([date, value]) => {
            const dataDate = new Date(eval(date));
            const year = dataDate.getFullYear();

            if (dataByYear[year]) {
              dataByYear[year] += value;
            } else {
              dataByYear[year] = value;
            }
          });

          Object.entries(dataByYear).forEach(([year, value]) => {
            const date = Date.UTC(year, 0, 1);
            mergedDataAll.push([date, value]);
          });

          this.filteredData = mergedDataAll;
          break;
      }

      this.chartOptions.series[0].data = this.filteredData;
    },
    showAllTime() {
      this.chartOptions.xAxis.labels.formatter = function () {
        return Highcharts.dateFormat("%Y", this.value);
      };
      const mergedData = [];
      const dataByYear = {};

      this.originalData.forEach(([date, value]) => {
        const dataDate = new Date(eval(date));
        const year = dataDate.getFullYear();

        if (dataByYear[year]) {
          dataByYear[year] += value;
        } else {
          dataByYear[year] = value;
        }
      });

      Object.entries(dataByYear).forEach(([year, value]) => {
        const date = Date.UTC(year, 0, 1);
        mergedData.push([date, value]);
      });

      this.filteredData = mergedData;
      this.chartOptions.series[0].data = this.filteredData;
    },
    isaktif(pathh) {
      return this.$route.path === pathh;
    },
    logout() {
      this.$store.dispatch("users/logout");
    },
  },
  created() {
    this.getuser();
    const usid = this.$cookies.get("loginCookie");
    if (usid) {
      this.profile = usid.data?.data;
      console.log(usid);
    } else {
      this.profile = null;
    }
  },
  mounted() {
    this.getPopularData();
    this.getRoleCounts();
    setTimeout(() => {
      this.loading = false;
    }, 2000);
  },
};
</script>
  
  <style scoped>
</style>