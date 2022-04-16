import { createRouter, createWebHistory } from "vue-router";

import TablaCarreras from "../components/tablas/tablaCarreras/TablaCarreras.vue";
import TablaGrupos from "../components/tablas/tablaGrupos/TablaGrupos.vue";
import TablaCursos from "../components/tablas/tablaCursos/TablaCursos.vue";
import TablaCiclos from "../components/tablas/tablaCiclos/TablaCiclos.vue";
import OfertaAcademica from "../components/ofertaAcademica/ofertaAcademica.vue";
import CrearCarrera from "@/components/carreras/CrearCarrera.vue";
import EditarCarrera from "@/components/carreras/EditarCarrera.vue";
import CrearCiclos from "@/components/ciclos/CrearCiclo.vue";
import EditarGrupo from "@/components/grupos/EditarGrupo.vue";
import CrearGrupo from "@/components/grupos/CrearGrupo.vue";
import EditarCiclos from "@/components/ciclos/EditarCiclo.vue";
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
        path: "cursos-carrera",
        name: "Cursos de Carrera",
        component: TablaCursos,
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
      {
        path: "oferta-academica",
        name: "Oferta Academica",
        component: OfertaAcademica,
      },
      {
        path: "grupos-curso",
        name: "Grupos de Curso",
        component: TablaGrupos,
      },
      {
        path: "crear-grupos",
        name: "Crear Grupos",
        component: CrearGrupo,
      },
      {
        path: "editar-grupo",
        name: "Editar Grupos",
        component: EditarGrupo,
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
