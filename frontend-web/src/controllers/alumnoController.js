"use strict";

import { global } from "../api-url/url.js";
import axios from "axios";

export default {
  login: async (alumno) => {
    const formData = new FormData();

    formData.append("cedula_alumno", alumno.cedula);
    formData.append("clave", alumno.password);

    return await axios
      .post(global.url + "login/alumno", formData)
      .then((res) => {
        if (res.status === 201) {
          return res.data;
        }
      })
      .catch((err) => {
        throw err.response;
      });
  },
  cargarAlumnos: async (token) => {
    return await axios
      .get(global.url + "alumnos", {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((err) => {
        throw err.response;
      });
  },
  registrarAlumno: async (alumno, token) => {
    const formData = new FormData();

    formData.append("cedula_alumno", alumno.cedula);
    formData.append("nombre", alumno.nombre);
    formData.append("telefono", alumno.telefono);
    formData.append("correoe", alumno.correoe);
    formData.append("fecha_nacimiento", alumno.fecha_nacimiento);
    formData.append("codigo_carrera", alumno.codigo_carrera);

    return await axios
      .post(global.url + "crear-alumno", formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  editarAlumno: async (alumno, token) => {
    const formData = new FormData();

    formData.append("nombre", alumno.nombre);
    formData.append("telefono", alumno.telefono);
    formData.append("correoe", alumno.correoe);
    formData.append("fecha_nacimiento", alumno.fecha_nacimiento);
    formData.append("codigo_carrera", alumno.codigo_carrera);

    return await axios
      .post(global.url + `alumno/editar/${alumno.cedula}`, formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  eliminarAlumno: async (alumno, token) => {
    return await axios
      .delete(global.url + `alumno/eliminar/${alumno.cedula_alumno}`, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  gruposMatriculados: async (alumno, token) => {
    return await axios
      .get(global.url + `grupos/alumno/${alumno.cedula_alumno}`, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((err) => {
        throw err.response;
      });
  },
  matriculas: async (cedula, token) => {
    return await axios
      .get(global.url + `alumno/matriculas/${cedula}`, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((err) => {
        throw err.response;
      });
  },
};
