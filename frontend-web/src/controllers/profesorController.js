"use strict";

import { global } from "../api-url/url.js";
import axios from "axios";

export default {
  login: async (profesor) => {
    const formData = new FormData();

    formData.append("cedula_profesor", profesor.cedula);
    formData.append("clave", profesor.password);

    return await axios
      .post(global.url + "login/profesor", formData)
      .then((res) => {
        if (res.status === 201) {
          return res.data;
        }
      })
      .catch((err) => {
        throw err.response;
      });
  },
  cargarProfesores: async (token) => {
    return await axios
      .get(global.url + "profesores", {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((err) => {
        throw err.response;
      });
  },
  registrarProfesor: async (profesor, token) => {
    const formData = new FormData();

    formData.append("cedula_profesor", profesor.cedula);
    formData.append("nombre", profesor.nombre);
    formData.append("telefono", profesor.telefono);
    formData.append("correo", profesor.correoE);

    return await axios
      .post(global.url + "crear-profesor", formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  editarProfesor: async (profesor, token) => {
    const formData = new FormData();

    formData.append("nombre", profesor.nombre);
    formData.append("telefono", profesor.telefono);
    formData.append("correo", profesor.correoE);

    return await axios
      .post(global.url + `profesor/editar/${profesor.cedula}`, formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  eliminarProfesor: async (profesor, token) => {
    return await axios
      .delete(global.url + `profesor/eliminar/${profesor.cedula_profesor}`, {
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
