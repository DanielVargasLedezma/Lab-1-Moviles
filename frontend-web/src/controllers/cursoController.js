"use strict";

import { global } from "../api-url/url.js";
import axios from "axios";

export default {
  cargarCursos: async (token) => {
    return await axios
      .get(global.url + "cursos", {
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
