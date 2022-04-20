"use strict";

import { global } from "../api-url/url.js";
import axios from "axios";

export default {
  cargarTodas: async (token) => {
    return await axios
      .get(global.url + "carreras", {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((err) => {
        throw err.response;
      });
  },
  registrarCarrera: async (carrera, token) => {
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
  editarCarrera: async (carrera, token) => {
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
  eliminarCarrera: async (carrera, token) => {
    return await axios
      .delete(global.url + `carrera/eliminar/${carrera.codigo_carrera}`, {
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
