<template>
  <div id="barrita">
    <span v-if="GET_VISIBILIDAD_COLUMNAS[0]" id="nombre">
      <div id="logo-usuario">
        <img
          id="userLogo"
          alt="User logo"
          src="../../../assets/svg/user-solid.svg"
        />
      </div>
      <p v-if="ciclo.numero_ciclo === '1'">Primer Ciclo</p>
      <p v-else-if="ciclo.numero_ciclo === '2'">Segundo Ciclo</p>
    </span>

    <span v-if="GET_VISIBILIDAD_COLUMNAS[1]"
      ><p>
        {{ ciclo.year }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[2]"
      ><p>
        {{ ciclo.fecha_inicio }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[3]"
      ><p>
        {{ ciclo.fecha_finalizacion }}
      </p></span
    >

    <span v-if="GET_VISIBILIDAD_COLUMNAS[4]">
      <div v-if="ciclo.ciclo_activo === '1'" id="estado-verde">Activo</div>
      <div v-else id="estado-rojo">No activo</div>
    </span>

    <span>
      <select @change="manageAction" id="combo-box-telefonos">
        <option disabled selected>Elegir</option>
        <option value="1">Editar</option>
        <option value="2">S. Default</option>
        <option value="3">Eliminar</option>
      </select>
    </span>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";

import "@/assets/css/TablaFila.css";

export default {
  computed: {
    ...mapGetters({
      GET_VISIBILIDAD_COLUMNAS: "TableCicloModule/GET_VISIBILIDAD_COLUMNAS",
      GET_MODAL_NUM: "TableCicloModule/GET_MODAL_NUM",
      GET_SERVICES: "TableCicloModule/GET_SERVICES",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
    }),
  },
  props: {
    ciclo: null,
  },
  methods: {
    ...mapMutations({
      SET_CICLO_ACTUAL: "TableCicloModule/SET_CICLO_ACTUAL",
      SET_MOSTRAR_TABLA: "TableCicloModule/SET_MOSTRAR_TABLA",
    }),
    manageAction: function (e) {
      switch (e.target.value) {
        case "1":
          this.SET_CICLO_ACTUAL(this.ciclo);
          this.$router.push("/inicio/editar-ciclo");

          break;
        case "2":
          break;
      }
    },
    ShowModal() {
      this.SET_MOSTRAR_TABLA(false);
    },
  },
};
</script>