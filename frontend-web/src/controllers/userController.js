"use strict";

import { global } from "../api-url/url.js";
import axios from "axios";

export default {
  login: async (user) => {
    const formData = new FormData();

    formData.append("cedula_usuario", user.cedula);
    formData.append("clave", user.password);

    return await axios
      .post(global.url + "login/user", formData)
      .then((res) => {
        if (res.status === 201) {
          return res.data;
        }
      })
      .catch((err) => {
        throw err.response;
      });
  },
  logout: async (token) => {
    return await axios
      .delete(global.url + "logout", {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        if (response.status === 200) {
          return response.status;
        }
      })
      .catch((error) => {
        throw error.response;
      });
  },
  cargarUsuarios: async (token) => {
    return await axios
      .get(global.url + "usuarios", {
        headers: {
          Authorization: "Bearer " + token,
        },
      })
      .then((response) => {
        if (response.data.data) {
          return response.data.data;
        }
      })
      .catch((error) => {
        throw error.response;
      });
  },
  editarUsuarios: async (usuario, token) => {
    const formData = new FormData();

    formData.append("cedula", usuario.cedula);
    formData.append("nombre", usuario.nombre);
    formData.append("tipo_usuario", usuario.tipo_usuario);
    formData.append("estado", usuario.estado);
    formData.append("correo", usuario.correoE);

    return await axios
      .post(global.url + `usuario/editar/${usuario.cedula}`, formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  registrarUsuarios: async (usuario, token) => {
    const formData = new FormData();

    formData.append("cedula_usuario", usuario.cedula);
    formData.append("nombre", usuario.nombre);
    formData.append("tipo_usuario", usuario.tipo_usuario);
    formData.append("estado", usuario.estado);
    formData.append("correoE", usuario.correoE);

    return await axios
      .post(global.url + "crear-usuario", formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  eliminarUsuario: async (usuario, token) => {
    return await axios
      .delete(global.url + `usuario/eliminar/${usuario.cedula_usuario}`, {
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
