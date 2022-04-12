import { createRouter, createWebHistory } from "vue-router";

import TablaCarreras from "../components/tablas/tablaCarreras/TablaCarreras.vue";
import CrearCarrera from "@/components/carreras/CrearCarrera.vue";
import EditarCarrera from "@/components/carreras/EditarCarrera.vue";
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
        path: "editar-carreras",
        name: "Editar Carreras",
        component: EditarCarrera,
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
