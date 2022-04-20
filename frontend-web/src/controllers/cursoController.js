"use strict";

import { global } from "../api-url/url.js";
import axios from "axios";

export default {
  cargarCursos: async (token) => {
    return await axios
      .get(global.url + "cursos", {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((err) => {
        throw err.response;
      });
  },
  registrarCurso: async (curso, token) => {
    const formData = new FormData();

    formData.append("codigo_curso", curso.codigo_curso);
    formData.append("codigo_carrera", curso.codigo_carrera);
    formData.append("nombre", curso.nombre);
    formData.append("creditos", curso.creditos);
    formData.append("horas_semanales", curso.horas_semanales);
    formData.append("num_semestre_a_llevar", curso.num_semestre_a_llevar);
    formData.append("anyo_a_llevar", curso.anyo_a_llevar);

    return await axios
      .post(global.url + "crear-cursos", formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  editarCurso: async (curso, token) => {
    const formData = new FormData();

    formData.append("nombre", curso.nombre);
    formData.append("titulo", curso.titulo);

    return await axios
      .post(global.url + `curso/editar/${curso.codigo_curso}`, formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  eliminarCurso: async (curso, token) => {
    return await axios
      .delete(global.url + `curso/eliminar/${curso.codigo_curso}`, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
};
