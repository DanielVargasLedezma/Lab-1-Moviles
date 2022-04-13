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
  registrarCiclo: async (ciclo, token) => {
    const formData = new FormData();

    formData.append("numero_ciclo", ciclo.numero_ciclo);
    formData.append("year", ciclo.year);
    formData.append("fecha_inicio", ciclo.fecha_inicio);
    formData.append("fecha_finalizacion", ciclo.fecha_finalizacion);
    formData.append("ciclo_activo", ciclo.ciclo_activo);

    return await axios
      .post(global.url + "crear-ciclo", formData, {
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
