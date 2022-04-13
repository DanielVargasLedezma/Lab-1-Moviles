import { createRouter, createWebHistory } from "vue-router";

import TablaCarreras from "../components/tablas/tablaCarreras/TablaCarreras.vue";
import TablaCursos from "../components/tablas/tablaCursos/TablaCursos.vue";
import TablaCiclos from "../components/tablas/tablaCiclos/TablaCiclos.vue";
import CrearCarrera from "@/components/carreras/CrearCarrera.vue";
import EditarCarrera from "@/components/carreras/EditarCarrera.vue";
import CrearCiclos from "@/components/ciclos/CrearCiclo.vue";
import EditarCiclos from "@/components/ciclos/CrearCiclo.vue";
import Login from "../components/login.vue";
import Home from "../components/home.vue";

const routes = [
  {
    path: "/",
    name: "login",
    component: Login,
  },
  {
    path: "/inicio",
    name: "Home",
    component: Home,
    children: [
      {
        path: "carreras",
        name: "Carreras",
        component: TablaCarreras,
      },
      {
        path: "crear-carreras",
        name: "Crear Carreras",
        component: CrearCarrera,
      },
      {
        path: "editar-carrera",
        name: "Editar Carreras",
        component: EditarCarrera,
      },
      {
        path: "cursos",
        name: "Cursos",
        component: TablaCursos,
      },
      {
        path: "ciclos",
        name: "Ciclos",
        component: TablaCiclos,
      },
      {
        path: "crear-ciclos",
        name: "Crear Ciclos",
        component: CrearCiclos,
      },
      {
        path: "editar-ciclo",
        name: "Editar Ciclo",
        component: EditarCiclos,
      },
      // { path: "crear-cursos", component: TablaUsuarios },
      // { path: "editar-usuario", component: EditarUsuario },
      // { path: "cambiar-clave", component: IngresarContra1 },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
