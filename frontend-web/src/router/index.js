import { createRouter, createWebHistory } from "vue-router";

import TablaCarreras from "../components/tablas/tablaCarreras/TablaCarreras.vue";
import EditarCarrera from "@/components/carreras/EditarCarrera.vue";
import CrearCarrera from "@/components/carreras/CrearCarrera.vue";

import TablaGrupos from "../components/tablas/tablaGrupos/TablaGrupos.vue";
import EditarGrupo from "@/components/grupos/EditarGrupo.vue";
import CrearGrupo from "@/components/grupos/CrearGrupo.vue";

import TablaCursos from "../components/tablas/tablaCursos/TablaCursos.vue";
import EditarCurso from "@/components/cursos/EditarCursos.vue";
import CrearCurso from "@/components/cursos/CrearCurso.vue";

import TablaCiclos from "../components/tablas/tablaCiclos/TablaCiclos.vue";
import EditarCiclos from "@/components/ciclos/EditarCiclo.vue";
import CrearCiclos from "@/components/ciclos/CrearCiclo.vue";

import TablaAlumnos from "../components/tablas/tablaAlumnos/TablaAlumnos.vue";
import EditarAlumno from "@/components/alumnos/EditarAlumnos.vue";
import CrearAlumno from "@/components/alumnos/CrearAlumnos.vue";

import TablaProfesores from "../components/tablas/tablaProfesores/TablaProfesores.vue";
import EditarProfesor from "@/components/profesores/EditarProfesor.vue";
import CrearProfesor from "@/components/profesores/CrearProfesor.vue";

import TableUsuario from "../components/tablas/tablaUsuarios/TablaUsuarios.vue";
import EditarUsuarios from "@/components/usuarios/EditarUsuarios.vue";
import CrearUsuarios from "@/components/usuarios/CrearUsuarios.vue";

import OfertaAcademica from "../components/ofertaAcademica/ofertaAcademica.vue";

import CrearMatricula from "@/components/matricula/CrearMatricula.vue";

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
        path: "crear-cursos",
        name: "Crear Cursos",
        component: CrearCurso,
      },
      {
        path: "editar-curso",
        name: "Editar Curso",
        component: EditarCurso,
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
      {
        path: "matricula",
        name: "Inicio Matricula",
        component: TablaAlumnos,
      },
      {
        path: "matricula-alumno/cursos",
        name: "Matricula Grupos de Alumno",
        component: TablaGrupos,
      },
      {
        path: "matricula-alumno/matricular",
        name: "Matricular grupos a Alumno",
        component: CrearMatricula,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
