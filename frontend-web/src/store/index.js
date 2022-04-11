import { createStore } from "vuex";
import LoginModule from "./modules/loginModule.js";
import topbarModule from "./modules/topbarModule.js";
import TableCarreraModule from "./modules/tableCarreraModule";

export default createStore({
  modules: {
    LoginModule,
    topbarModule,
    TableCarreraModule,
  },
});
