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
        // console.log(response);
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
  cargarGestores: async (token) => {
    return await axios
      .get(global.url + "gestores", {
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
  editarUsuario: async (user, token) => {
    const formData = new FormData();
    formData.append("_method", "PATCH");
    formData.append("nombre", user.nombre);
    formData.append("apellidos", user.apellidos);
    formData.append("nombre_usuario", user.nombre_usuario);
    formData.append("cedula", user.cedula);
    formData.append("estado", user.estado);
    formData.append("correo", user.correo);
    formData.append("id_rol", user.id_rol);
    formData.append("id_proyecto", user.id_proyecto);

    return await axios
      .post(global.url + "editar-usuario/" + user.id, formData, {
        headers: {
          Authorization: "Bearer " + token,
        },
      })
      .then((response) => {
        if (response.data) {
          return response.data;
        }
      })
      .catch((error) => {
        throw error.response;
      });
  },
  editarEstadoUsuario: async (user, token) => {
    const formData = new FormData();
    formData.append("_method", "PATCH");
    formData.append("estado", user.estado);
    return await axios
      .post(global.url + "editar-estado-usuario/" + user.id, formData, {
        headers: {
          Authorization: "Bearer " + token,
        },
      })
      .then((response) => {
        if (response.data) {
          return response.data;
        }
      })
      .catch((error) => {
        throw error.response;
      });
  },
  insertarUsuarios: async (user, token) => {
    const formData = new FormData();
    formData.append("nombre", user.nombre);
    formData.append("apellidos", user.apellidos);
    formData.append("nombre_usuario", user.nombre_usuario);
    formData.append("cedula", user.cedula);
    formData.append("correo", user.correo);
    formData.append("id_rol", user.id_rol);
    formData.append("id_proyecto", user.id_proyecto);

    return await axios
      .post(global.url + "usuarios", formData, {
        headers: { Authorization: "Bearer " + token },
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
  enviarCodigo: async (email) => {
    const formData = new FormData();
    formData.append("correo", email);

    return await axios
      .post(global.url + "usuarios/recuperar-contra", formData)
      .then((res) => {
        if (res.status === 201) {
          return res.status;
        }
      })
      .catch((err) => {
        throw err.response;
      });
  },
  confirmarCodigo: async (codigo, email) => {
    const formData = new FormData();
    formData.append("correo", email);
    formData.append("codigo", codigo);

    return await axios
      .post(global.url + "usuarios/verificar-codigo", formData)
      .then((res) => {
        if (res.status === 200) {
          return res.data;
        }
      })
      .catch((error) => {
        throw error.response;
      });
  },
  eliminarCodigosDe: async (id) => {
    return await axios
      .delete(global.url + "usuarios/eliminar-codigos/" + id)
      .then((res) => {
        if (res.status === 204) {
          return res.status;
        }
      })
      .catch((error) => {
        throw error;
      });
  },
  cambiarContraseña: async (contraseña, confirmacion, id) => {
    const formData = new FormData();

    formData.append("contraseña", contraseña);
    formData.append("contraseña_confirmation", confirmacion);

    return await axios
      .post(global.url + "usuarios/reiniciar-contra/" + id, formData)
      .then((response) => {
        if (response.status === 204) {
          return response.status;
        }
      })
      .catch((error) => {
        throw error.response;
      });
  },

  cambiarContra: async (password_act, password, password_conf, id, token) => {
    const formData = new FormData();

    formData.append("actualpassword", password_act);
    formData.append("password", password);
    formData.append("password_confirmation", password_conf);

    return await axios
      .post(global.url + "usuarios/cambio-contrasenna/" + id, formData, {
        headers: { Authorization: "Bearer " + token },
      })
      .then((response) => {
        if (response.status == 204) {
          return response.status;
        }
      })
      .catch((error) => {
        throw error.response;
      });
  },
  desasignarCobroAGestor: async (id_cobro, id_supervisor, id_gestor, token) => {
    const formData = new FormData();

    formData.append("id_supervisor", id_supervisor);
    formData.append("id_gestor", id_gestor);

    return await axios
      .post(
        global.url + `informacion-cobros/desasignar/${id_cobro}`,
        formData,
        {
          headers: { Authorization: "Bearer " + token },
        }
      )
      .then((response) => {
        return response.status;
      })
      .catch((error) => {
        throw error.response;
      });
  },
  asignarCobroAGestor: async (id_cobro, id_supervisor, id_gestor, token) => {
    const formData = new FormData();

    formData.append("id_supervisor", id_supervisor);
    formData.append("id_gestor", id_gestor);

    return await axios
      .post(global.url + `informacion-cobros/asignar/${id_cobro}`, formData, {
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
