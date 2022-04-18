<template>
  <div id="indices">
    <div id="left">
      <select id="combo-box-oculto" @change="cambiarVisibilidadColumna">
        <option>Columnas Ocultas ({{ Cantidad_Ocultos }})</option>
        <option
          v-for="(columna, index) in GET_COLUMNS_TITLE.length"
          :key="index"
        >
          <p v-if="GET_VISIBILIDAD_COLUMNAS[index]">
            {{ GET_COLUMNS_TITLE[index] }}
          </p>
          <p v-else id="oculto">
            {{ GET_COLUMNS_TITLE[index] }}
          </p>
        </option>
      </select>
    </div>
    <div id="right">
      <select
        id="combo-box-usuarios"
        @change="cambiarPagina"
        :selectedIndex="GET_PAGINA_ACTUAL - 1"
      >
        <option
          v-for="(num, index) in Math.ceil(GET_CANTIDAD_UoC / 10)"
          :key="index"
          :value="index"
        >
          {{ num * 10 - 9 }}-{{
            num * 10 > GET_CANTIDAD_UoC ? GET_CANTIDAD_UoC : num * 10
          }}
          de
          {{ GET_CANTIDAD_UoC }}
        </option>
      </select>
      <div class="span-arrow" @click="cambiarPaginaGradual(false)">
        <img src="./../../../assets/svg/angles-left-solid.svg" alt="" />
      </div>
      <div class="span-arrow" @click="cambiarPaginaGradual(true)">
        <img src="./../../../assets/svg/angles-right-solid.svg" alt="" />
      </div>
    </div>
  </div>
</template>
<script>
import { mapMutations, mapGetters } from "vuex";

import "@/assets/css/TablaIndices.css";

export default {
  computed: {
    ...mapGetters({
      GetUsuarios: "TableProfesorModule/GetUsuarios",
      GetTexto: "TableProfesorModule/GetTexto",
      GET_COLUMNS_TITLE: "TableProfesorModule/GET_COLUMNS_TITLE",

      GET_CANTIDAD_UoC: "TableProfesorModule/GET_CANTIDAD_UoC",
      GET_PAGINA_ACTUAL: "TableProfesorModule/GET_PAGINA_ACTUAL",
      GET_VISIBILIDAD_COLUMNAS: "TableProfesorModule/GET_VISIBILIDAD_COLUMNAS",
    }),
    Cantidad_Ocultos: function () {
      var ocultos = 0;
      for (
        let index = 0;
        index < this.GET_VISIBILIDAD_COLUMNAS.length;
        index++
      ) {
        if (!this.GET_VISIBILIDAD_COLUMNAS[index]) {
          ocultos++;
        }
      }
      return ocultos;
    },
  },
  methods: {
    ...mapMutations({
      SET_VISIBILIDAD_COLUMNAS: "TableProfesorModule/SET_VISIBILIDAD_COLUMNAS",
      SET_PAGINA_ACTUAL: "TableProfesorModule/SET_PAGINA_ACTUAL",
    }),
    cambiarPaginaGradual(parametro) {
      if (parametro) {
        let numPagina =
          this.GET_PAGINA_ACTUAL < Math.ceil(this.GET_CANTIDAD_UoC / 10)
            ? this.GET_PAGINA_ACTUAL + 1
            : this.GET_PAGINA_ACTUAL;
        this.SET_PAGINA_ACTUAL(numPagina);
      } else {
        let numPagina =
          this.GET_PAGINA_ACTUAL > 1
            ? this.GET_PAGINA_ACTUAL - 1
            : this.GET_PAGINA_ACTUAL;
        this.SET_PAGINA_ACTUAL(numPagina);
      }
    },
    cambiarPagina(e) {
      if (e.target.options.selectedIndex > -1) {
        this.SET_PAGINA_ACTUAL(e.target.options.selectedIndex + 1);
      }
    },
    cambiarVisibilidadColumna(e) {
      this.SET_VISIBILIDAD_COLUMNAS(e.target.options.selectedIndex - 1);
      e.target.options.selectedIndex = 0;
    },
  },
};
</script>