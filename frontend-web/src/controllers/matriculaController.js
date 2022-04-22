"use strict";

import { global } from "../api-url/url.js";
import axios from "axios";

export default {
  realizarMatricula: async (matricula, token) => {
    const formData = new FormData();

    formData.append("cedula_alumno", matricula.cedula_alumno);
    formData.append("numero_grupo", matricula.numero_grupo);

    return await axios
      .post(global.url + "crear-matricula", formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  desmatricular: async (numero_grupo, cedula_alumno, token) => {
    return await axios
      .delete(global.url + `desmatricular/${cedula_alumno}/${numero_grupo}`, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  obtenerMatricula: async (numero_grupo, cedula_alumno, token) => {
    return await axios
      .get(global.url + `matricula/${cedula_alumno}/${numero_grupo}`, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  editarNota: async (matricula, token) => {
    const formData = new FormData();

    formData.append("nota", matricula.nota);

    return await axios
      .post(global.url + `registrar-nota/${matricula.numero_matricula}`, formData, {
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
