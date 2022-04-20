"use strict";

import { global } from "../api-url/url.js";
import axios from "axios";

export default {
  cargarGruposDeCurso: async (token, codigo_curso) => {
    return await axios
      .get(global.url + `grupos/curso/${codigo_curso}`, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((err) => {
        throw err.response;
      });
  },
  cargarGruposDeProfesor: async (token, cedula_profesor) => {
    return await axios
      .get(global.url + `grupos/profesor/${cedula_profesor}`, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((err) => {
        throw err.response;
      });
  },
  cargarGruposDeCarrera: async (token, codigo_carrera) => {
    return await axios
      .get(global.url + `grupos/carrera/${codigo_carrera}`, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.data.data;
      })
      .catch((err) => {
        throw err.response;
      });
  },
  registrarGrupo: async (grupo, token) => {
    const formData = new FormData();

    formData.append("numero_grupo", grupo.numero_grupo);
    formData.append("codigo_curso", grupo.codigo_curso);
    formData.append("cedula_profesor", grupo.cedula_profesor);
    formData.append("id_ciclo", grupo.id_ciclo);
    formData.append(
      "horario",
      grupo.horario_inicio + "-" + grupo.horario_final
    );
    formData.append("dia_uno", grupo.dia_uno);
    formData.append("dia_dos", grupo.dia_dos);

    return await axios
      .post(global.url + "crear-grupo", formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  editarGrupo: async (grupo, token) => {
    const formData = new FormData();

    formData.append("codigo_curso", grupo.codigo_curso);
    formData.append("cedula_profesor", grupo.cedula_profesor);
    formData.append("id_ciclo", grupo.id_ciclo);
    formData.append(
      "horario",
      grupo.horario_inicio + "-" + grupo.horario_final
    );
    formData.append("dia_uno", grupo.dia_uno);
    formData.append("dia_dos", grupo.dia_dos);

    return await axios
      .post(global.url + `grupos/editar/${grupo.numero_grupo}`, formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  eliminarGrupo: async (grupo, token) => {
    return await axios
      .delete(global.url + `grupo/eliminar/${grupo.numero_grupo}`, {
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
