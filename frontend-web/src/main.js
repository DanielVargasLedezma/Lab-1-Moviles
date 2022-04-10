import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

import { library, dom } from "@fortawesome/fontawesome-svg-core";

import { faEyeSlash, faEye } from "@fortawesome/free-solid-svg-icons";

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

dom.watch();

library.add(faEyeSlash, faEye);

const app = createApp(App).use(store).use(router);

app.component("font-awesome-icon", FontAwesomeIcon);

app.mount("#app");
