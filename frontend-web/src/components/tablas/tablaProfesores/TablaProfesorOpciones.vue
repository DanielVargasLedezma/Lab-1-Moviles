<template>
  <div id="barra-opciones">
    <div id="filtro">
      <br />
      <h1>{{ this.GET_TABLE_NAME }}</h1>
      <div id="opciones-busqueda">
        <input
          type="text"
          id="busqueda"
          placeholder="Buscar por código o nombre de la carrera"
          @change="handleTextChange"
        />
        <h3>Ordenar por</h3>
        <select id="combo-box" @change="cambiarOrdenTabla">
          <option
            v-for="index in opcionesOrdenado.length * 2"
            :key="index"
            :value="opcionesOrdenado[parseInt((index - 1) / 2)]"
          >
            {{ opcionesOrdenado[parseInt((index - 1) / 2)] }} -
            {{ (index - 1) % 2 == 0 ? "Ascendente" : "Descendente" }}
          </option>
        </select>
      </div>
    </div>
    <div v-if="accionBoton != null" id="boton">
      <button
        v-if="UsuarioLoggeado.tipo_usuario == 1"
        @click="accionBoton"
        id="agregar-usuario"
      >
        <img src="./../../../assets/svg/plus-circle.svg" />Añadir Profesor
      </button>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";

import "@/assets/css/TablaOpciones.css";

export default {
  data() {
    return {
      texto: "",
    };
  },
  props: { opcionesOrdenado: null, accionBoton: null },
  computed: {
    ...mapGetters({
      GET_TABLE_NAME: "TableProfesorModule/GET_TABLE_NAME",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
    }),
  },
  methods: {
    ...mapMutations({
      SET_OPC_COMBO_BOX_REVERSE:
        "TableProfesorModule/SET_OPC_COMBO_BOX_REVERSE",
      SET_OPC_COMBO_BOX: "TableProfesorModule/SET_OPC_COMBO_BOX",
      SET_TEXTO: "TableProfesorModule/SET_TEXTO",
    }),
    handleTextChange(e) {
      if (e.target) {
        this.SET_TEXTO(e.target.value);
      }
    },
    cambiarOrdenTabla(e) {
      if (e.target.options.selectedIndex > -1) {
        let string = e.target.options[e.target.options.selectedIndex].value;
        if (e.target.options.selectedIndex % 2 == 0) {
          this.SET_OPC_COMBO_BOX_REVERSE(false);
        } else {
          this.SET_OPC_COMBO_BOX_REVERSE(true);
        }
        this.SET_OPC_COMBO_BOX(string);
      }
    },
  },
};
</script>