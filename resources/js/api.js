import { h } from "vue";
import Game from "@/api/game";


// Initialize all or API factories
const factories = {
    game: Game(h.axios)
};

// Make them available in the app with this.$api
// https://vuejs.org/v2/cookbook/adding-instance-properties.html
h.$api = factories;
