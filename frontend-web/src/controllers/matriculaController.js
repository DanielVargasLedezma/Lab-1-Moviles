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
  desmatricular: async (numero_grupo, cedula_alumno) => {
    return await axios
      .delete(global.url + `desmatricular/${cedula_alumno}/${numero_grupo}`)
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error;
      });
  },
};
