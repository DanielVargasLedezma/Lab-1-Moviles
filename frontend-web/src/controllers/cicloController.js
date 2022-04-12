"use strict";

import { global } from "../api-url/url.js";
import axios from "axios";

export default {
  cargarCiclos: async (token) => {
    return await axios
      .get(global.url + "ciclos", {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((err) => {
        throw err.response;
      });
  },
  registrarCiclo: async (carrera, token) => {
    const formData = new FormData();

    formData.append("codigo_carrera", carrera.codigo_carrera);
    formData.append("nombre", carrera.nombre);
    formData.append("titulo", carrera.titulo);

    return await axios
      .post(global.url + "crear-carrera", formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  editarCiclo: async (carrera, token) => {
    const formData = new FormData();

    formData.append("nombre", carrera.nombre);
    formData.append("titulo", carrera.titulo);

    return await axios
      .post(global.url + `carrera/editar/${carrera.codigo_carrera}`, formData, {
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
