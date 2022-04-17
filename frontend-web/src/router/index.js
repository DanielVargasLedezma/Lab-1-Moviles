import { createRouter, createWebHistory } from "vue-router";

import TablaCarreras from "../components/tablas/tablaCarreras/TablaCarreras.vue";
import TablaCursos from "../components/tablas/tablaCursos/TablaCursos.vue";
import TablaCiclos from "../components/tablas/tablaCiclos/TablaCiclos.vue";
import TablaAlumnos from "../components/tablas/tablaAlumnos/TablaAlumnos.vue";
import TablaProfesores from "../components/tablas/tablaProfesores/TablaProfesores.vue";
import TableUsuario from "../components/tablas/tablaUsuarios/TablaUsuarios.vue";
import CrearCarrera from "@/components/carreras/CrearCarrera.vue";
import EditarCarrera from "@/components/carreras/EditarCarrera.vue";
import CrearCiclos from "@/components/ciclos/CrearCiclo.vue";
import EditarCiclos from "@/components/ciclos/CrearCiclo.vue";
import CrearProfesor from "@/components/profesores/CrearProfesor.vue";
import EditarProfesor from "@/components/profesores/EditarProfesor.vue";
import CrearAlumno from "@/components/alumnos/CrearAlumnos.vue";
import EditarAlumno from "@/components/alumnos/EditarAlumnos.vue";
import CrearUsuarios from "@/components/usuarios/CrearUsuarios.vue";
import EditarUsuarios from "@/components/usuarios/EditarUsuarios.vue";
import CrearCurso from "@/components/cursos/CrearCurso.vue";
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
        path: "crear-cursos",
        name: "Crear Cursos",
        component: CrearCurso,
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
        path: "alumnos",
        name: "Alumnos",
        component: TablaAlumnos,
      },
      {
        path: "crear-alumno",
        name: "Crear Alumno",
        component: CrearAlumno,
      },
      {
        path: "editar-alumno",
        name: "Editar Alumno",
        component: EditarAlumno,
      },
      {
        path: "profesores",
        name: "Profesores",
        component: TablaProfesores,
      },
      {
        path: "crear-profesor",
        name: "Crear Profesor",
        component: CrearProfesor,
      },
      {
        path: "editar-profesor",
        name: "Editar Profesor",
        component: EditarProfesor,
      },
      {
        path: "usuarios",
        name: "Usuarios",
        component: TableUsuario,
      },
      {
        path: "crear-usuarios",
        name: "Crear Usuarios",
        component: CrearUsuarios,
      },
      {
        path: "editar-usuario",
        name: "Editar Usuario",
        component: EditarUsuarios,
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
