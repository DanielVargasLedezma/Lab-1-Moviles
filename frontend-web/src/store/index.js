import { createStore } from "vuex";

import LoginModule from "./modules/loginModule.js";
import topbarModule from "./modules/topbarModule.js";
import TableCursoModule from "./modules/tableCursoModule";
import TableCicloModule from "./modules/tableCicloModule";
import TableCarreraModule from "./modules/tableCarreraModule";
import TableGrupoModule from "./modules/tableGrupoModule";

export default createStore({
  modules: {
    LoginModule,
    topbarModule,
    TableCursoModule,
    TableCicloModule,
    TableCarreraModule,
    TableGrupoModule,
  },
});
