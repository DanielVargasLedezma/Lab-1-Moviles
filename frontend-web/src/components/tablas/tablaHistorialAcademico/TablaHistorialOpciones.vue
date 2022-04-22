<template>
  <div id="barra-opciones">
    <div id="filtro">
      <br />
      <h1>{{ this.GET_TABLE_NAME }}</h1>
      <div id="opciones-busqueda">
        <input
          type="text"
          id="busqueda"
          placeholder="Buscar por número de grupo, profesor o año del ciclo"
          @change="handleTextChange"
        />
        <h3>Ordenar por</h3>
        <select id="combo-box" @change="cambiarOrdenTabla">
          <option value="numero_grupo">Por defecto</option>
          <option :value="opcionesOrdenado[0]">
            Número Grupo - Ascendente
          </option>
          <option :value="opcionesOrdenado[0]">
            Número Grupo - Descendente
          </option>
          <option :value="opcionesOrdenado[1]">Profesor - Ascendente</option>
          <option :value="opcionesOrdenado[1]">Profesor - Descendente</option>
          <option :value="opcionesOrdenado[2]">
            Año de Ciclo - Ascendente
          </option>
          <option :value="opcionesOrdenado[2]">
            Año de Ciclo - Descendente
          </option>
        </select>
      </div>
    </div>
    <div v-if="accionBoton !== null" id="boton">
      <button
        v-if="
          UsuarioLoggeado.tipo_usuario == 1 && path === '/inicio/grupos-curso'
        "
        @click="accionBoton"
        id="agregar-usuario"
      >
        <img src="./../../../assets/svg/plus-circle.svg" />Añadir Grupo
      </button>
      <button
        v-if="path === '/inicio/matricula-alumno/cursos'"
        @click="redirigirMatricular"
        id="agregar-usuario"
      >
        <img src="./../../../assets/svg/plus-circle.svg" />Matricular Grupo
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
      path: "",
    };
  },
  mounted() {
    this.path = window.location.pathname;
  },
  props: { opcionesOrdenado: null, accionBoton: null },
  computed: {
    ...mapGetters({
      GET_TABLE_NAME: "TableHistorialModule/GET_TABLE_NAME",

      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
    }),
  },
  methods: {
    ...mapMutations({
      SET_OPC_COMBO_BOX_REVERSE:
        "TableHistorialModule/SET_OPC_COMBO_BOX_REVERSE",
      SET_OPC_COMBO_BOX: "TableHistorialModule/SET_OPC_COMBO_BOX",
      SET_TEXTO: "TableHistorialModule/SET_TEXTO",
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
    redirigirMatricular: function () {
      this.$router.push("/inicio/matricula-alumno/matricular");
    },
  },
};
</script>