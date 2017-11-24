/**
 * Our Vue.js application.
 *
 * This manages the entire front-end website.
 */

let FOOT_API_URI = "https://map.tn/airport/foot.php";

// The amount of milliseconds (ms) after which we should update the table
let UPDATE_INTERVAL = 60 * 1000;

let app = new Vue({
  el: "#app",
  data: {
    games: []
  },
  methods: {
    getGames: function() {
      let self = this;

      axios.get(FOOT_API_URI)
        .then((resp) => {
          this.games = resp.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },

  },
  created: function () {
    this.getGames();
  }
});

setInterval(() => {
  app.getGames();
}, UPDATE_INTERVAL);
