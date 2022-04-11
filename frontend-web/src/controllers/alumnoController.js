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
};
