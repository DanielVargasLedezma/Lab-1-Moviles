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
};
