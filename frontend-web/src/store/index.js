import { createStore } from "vuex";
import LoginModule from "./modules/loginModule.js";

export default createStore({
  modules: {
    LoginModule,
  },
});
