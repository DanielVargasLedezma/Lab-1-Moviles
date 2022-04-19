<template>
  <section>
    <section
      v-if="
        LoggedState && UsuarioLoggeado && UsuarioLoggeado.tipo_usuario === 1
      "
    >
      <div id="titulo-container">
        <h1 id="titulo">Edición de Grupos</h1>
      </div>
      <div id="addContainer">
        <div id="col1">
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="nombre">Profesor</label>
              </div>
              <section id="input-span">
                <select
                  name="cedula_profesor"
                  id="rolCombo"
                  @change="handleValueChange"
                  @blur="touchInput"
                  :class="[{ error: v$.grupo.cedula_profesor.$error }]"
                  :value="grupo.cedula_profesor"
                >
                  <option value="default" selected="Selected" disabled>
                    Seleccionar
                  </option>
                  <option
                    v-for="(profesor, index) in profesores"
                    :key="index"
                    :value="profesor.cedula_profesor"
                  >
                    {{ profesor.cedula_profesor }} - {{ profesor.nombre }}
                  </option>
                </select>
              </section>
              <span
                class="validation-error"
                v-if="v$.grupo.cedula_profesor.$error"
              >
                Este campo es requerido
              </span>
            </section>
          </div>

          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="nombreUsuario">Ciclo a elegir</label>
              </div>
              <section id="input-span">
                <select
                  name="id_ciclo"
                  id="rolCombo"
                  ref="select_ciclo"
                  @change="handleValueChange"
                  @blur="touchInput"
                  :class="[{ error: v$.grupo.id_ciclo.$error }]"
                  :value="grupo.id_ciclo"
                >
                  <option
                    v-for="(ciclo, index) in ciclos"
                    :key="index"
                    :value="ciclo.id_ciclo"
                  >
                    {{
                      ciclo.numero_ciclo === "1"
                        ? "Ciclo I de "
                        : "Ciclo II de "
                    }}
                    {{ ciclo.year }}
                  </option>
                </select>
              </section>
              <span class="validation-error" v-if="v$.grupo.id_ciclo.$error">
                Este campo es requerido.
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="nombre">Día - Primero</label>
              </div>
              <section id="input-span">
                <select
                  name="dia_uno"
                  id="rolCombo"
                  @change="handleValueChange"
                  @blur="touchInput"
                  :class="[{ error: v$.grupo.dia_uno.$error }]"
                  :value="grupo.dia_uno"
                >
                  <option value="default" selected="Selected" disabled>
                    Seleccionar
                  </option>
                  <option value="L">Lunes</option>
                  <option value="M">Martes</option>
                  <option value="W">Miércoles</option>
                  <option value="J">Jueves</option>
                  <option value="V">Viernes</option>
                  <option value="S">Sábado</option>
                </select>
              </section>
              <span class="validation-error" v-if="v$.grupo.dia_uno.$error">
                Este campo es requerido.
              </span>
            </section>
          </div>
        </div>
        <div id="col2">
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="nombre">Día - Segundo</label>
              </div>
              <section id="input-span">
                <select
                  name="dia_dos"
                  id="rolCombo"
                  @change="handleValueChange"
                  @blur="touchInput"
                  :class="[{ error: v$.grupo.dia_dos.$error }]"
                  :value="grupo.dia_dos"
                >
                  <option value="" selected="Selected">Seleccionar</option>
                  <option value="L">Lunes</option>
                  <option value="M">Martes</option>
                  <option value="W">Miércoles</option>
                  <option value="J">Jueves</option>
                  <option value="V">Viernes</option>
                  <option value="S">Sábado</option>
                </select>
                <span id="input-feature" @click="clearField"
                  ><img src="./../../assets/svg/removesign.svg" alt=""
                /></span>
              </section>
              <span class="validation-error" v-if="v$.grupo.dia_dos.$error">
                Opcional pero debe ser diferente a día uno.
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper" class="select">
              <div id="div-labels">
                <label for="fechaVencimiento">Horario - Hora de inicio</label>
              </div>
              <div class="fecha_vencimiento">
                <div id="div-labels"></div>
                <section id="input-span">
                  <input
                    id="fechaVencimiento"
                    name="horario_inicio"
                    class="input-3"
                    type="time"
                    @blur="touchInput"
                    @input="touchInput"
                    @change="resetFinal"
                    v-model="grupo.horario_inicio"
                    :class="[{ error: v$.grupo.horario_inicio.$error }]"
                  />
                  <span
                    class="question"
                    :class="[{ error: v$.grupo.horario_inicio.$error }]"
                  >
                    <img
                      class="helpimg"
                      name="horario_inicio"
                      @click="showHelp"
                      src="../../assets/svg/questionsign.svg"
                      alt="help"
                    />
                  </span>
                </section>
                <span
                  class="validation-error"
                  v-if="v$.grupo.horario_inicio.$error"
                >
                  Este campo es requerido.
                </span>
              </div>
            </section>
          </div>
          <div>
            <section id="wrapper" class="select">
              <div id="div-labels">
                <label for="proyecto">Horario - Hora de cierre</label>
              </div>
              <div class="fecha_vencimiento">
                <div id="div-labels"></div>
                <section id="input-span">
                  <input
                    type="time"
                    id="fechaVencimiento"
                    name="horario_final"
                    class="input-3"
                    :disabled="grupo.horario_inicio === ''"
                    @blur="touchInput"
                    @input="touchInput"
                    :class="[{ error: v$.grupo.horario_final.$error }]"
                    v-model="grupo.horario_final"
                  />
                  <span
                    class="question"
                    :class="[{ error: v$.grupo.horario_final.$error }]"
                  >
                    <img
                      class="helpimg"
                      name="horario_final"
                      @click="showHelp"
                      src="../../assets/svg/questionsign.svg"
                      alt="help"
                    />
                  </span>
                </section>
                <span
                  class="validation-error"
                  v-if="v$.grupo.horario_final.$error"
                >
                  Debe seleccionar la hora de cierre.
                </span>
              </div>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <label style="visibility: hidden">Hola</label>
              <button type="submit" @click="editarGrupo">Editar Grupo</button>
            </section>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
import { required, numeric, sameAs, not } from "@vuelidate/validators";
import { mapMutations, mapGetters } from "vuex";
import useValidate from "@vuelidate/core";
import swal from "sweetalert2";

import profesorController from "../../controllers/profesorController.js";
import cicloController from "../../controllers/cicloController.js";
import grupoController from "../../controllers/grupoController.js";
import Grupo from "@/models/grupo.js";
import carreraController from "../../controllers/carreraController.js";

export default {
  data() {
    return {
      v$: useValidate(),
      grupo: new Grupo(),
      min_despues: "",
      ciclos: [],
      profesores: [],
      carreras: [],
    };
  },
  validations() {
    return {
      grupo: {
        numero_grupo: { required },
        codigo_curso: { required },
        cedula_profesor: { required },
        id_ciclo: { required, numeric },
        horario_inicio: { required },
        horario_final: { required },
        dia_uno: { required },
        dia_dos: { diferente: not(sameAs(this.getDiaUno)) },
      },
    };
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      LoggedState: "LoginModule/LoggedState",
      Token: "LoginModule/Token",

      GET_Grupo_ACTUAL: "TableGrupoModule/GET_GRUPO_ACTUAL",
    }),
    getDiaUno: function () {
      return this.grupo.dia_uno;
    },
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    this.grupo.numero_grupo = this.GET_Grupo_ACTUAL.numero_grupo;
    this.grupo.codigo_curso = this.GET_Grupo_ACTUAL.curso.codigo_curso;
    this.grupo.cedula_profesor = this.GET_Grupo_ACTUAL.profesor.cedula_profesor;
    this.grupo.id_ciclo = this.GET_Grupo_ACTUAL.ciclo.id_ciclo;

    var horario = this.GET_Grupo_ACTUAL.horario.split("-");

    this.grupo.horario_inicio = horario[0];
    this.grupo.horario_final = horario[1];

    this.grupo.dia_uno = this.GET_Grupo_ACTUAL.dia_uno;
    this.grupo.dia_dos = this.GET_Grupo_ACTUAL.dia_dos;

    await profesorController
      .cargarProfesores(this.Token)
      .then((response) => {
        this.profesores = response;
      })
      .catch((error) => {
        console.error(error);
      });

    await cicloController
      .cargarCiclos(this.Token)
      .then((response) => {
        this.ciclos = response;
      })
      .catch((error) => {
        console.error(error);
      });

    await carreraController
      .cargarTodas(this.Token)
      .then((response) => {
        this.carreras = response;
      })
      .catch((error) => {
        console.error(error);
      });
  },
  methods: {
    ...mapMutations({
      LogOut: "LoginModule/logout",
    }),
    async editarGrupo() {
      await this.v$.$validate();

      if (!this.v$.$error) {
        await grupoController
          .editarGrupo(this.grupo, this.Token)
          .then((response) => {
            if (response === 204) {
              swal.fire(
                "¡Grupo Editado!",
                "El grupo ha sido registrado con éxito.",
                "success"
              );
              this.$router.push("/inicio/grupos-curso");
            }
          })
          .catch((error) => {
            console.error(error.data);
            swal.fire("¡Error!", `${error.data.message}`, "error");
          });
      }
    },
    showHelp(e) {
      switch (e.target.name) {
        case "numero_grupo":
          swal.fire(
            "Número de Grupo",
            "En este apartado debe ingresar el número de grupo a ingresar. Debe ser una cadena usando números y letras significativas.",
            "info"
          );
          break;
        case "fecha_inicio":
          swal.fire(
            "Fecha de inicio del Ciclo",
            "En este apartado debe ingresar la fecha de inicio del ciclo a ingresar. Puede ser una fecha pasada.",
            "info"
          );
          break;
        case "fecha_finalizacion":
          swal.fire(
            "Fecha de finalización del Ciclo",
            "En este apartado debe ingresar la fecha de finalización del ciclo a ingresar.",
            "info"
          );
          break;
      }
    },
    touchInput: function (e) {
      switch (e.target.name) {
        case "numero_grupo":
          this.v$.grupo.numero_grupo.$touch();
          break;
        case "cedula_profesor":
          this.v$.grupo.cedula_profesor.$touch();
          break;
        case "id_ciclo":
          this.v$.grupo.id_ciclo.$touch();
          break;
        case "horario_inicio":
          this.v$.grupo.horario_inicio.$touch();
          break;
        case "horario_final":
          this.v$.grupo.horario_final.$touch();
          break;
        case "dia_uno":
          this.v$.grupo.dia_uno.$touch();
          break;
        case "dia_dos":
          this.v$.grupo.dia_dos.$touch();
          break;
      }
    },
    handleValueChange: function (e) {
      switch (e.target.name) {
        case "cedula_profesor":
          this.grupo.cedula_profesor = e.target.value;
          break;
        case "id_ciclo":
          this.grupo.id_ciclo = parseInt(e.target.value);
          break;
        case "dia_uno":
          this.grupo.dia_uno = e.target.value;
          break;
        case "dia_dos":
          this.grupo.dia_dos = e.target.value;
          break;
      }
    },
    clearField: function () {
      this.grupo.dia_dos = "";
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap");
.validation-error {
  font-family: "Inter", sans-serif;
  color: red;
  flex-grow: 0;
}
textarea {
  width: 18rem;
  max-width: 18rem;
}
#editar-usuarios-container {
  height: 100%;
  overflow-y: scroll;
}
#titulo-container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

#editar-usuarios-header-switch {
  display: flex;
  align-items: center;
}
.switch {
  position: relative;
  display: inline-block;
  width: 160px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #f44336;
  -webkit-transition: 0.4s;
  transition: 0.4s;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-end;
  box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px,
    rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px,
    rgba(0, 0, 0, 0.07) 0px 16px 16px;
  border-radius: 5px;
  font-family: "Inter", sans-serif;
  font-size: medium;
  color: #ffffff;
  text-align: center;
  user-select: none;
}

.slider div {
  padding-right: 10px;
  padding-left: 10px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  /*background-color: white;*/
  border-radius: 5px;
  -webkit-transition: 0.4s;
  transition: 0.4s;
  background-image: url(../../assets/img/logosolo.png);
  background-size: contain;
}

input:checked + .slider {
  background-color: #4caf50;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px,
    rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px,
    rgba(0, 0, 0, 0.07) 0px 16px 16px;
}

input:focus + .slider {
  box-shadow: 0 0 10px #2196f3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(126px);
  border-radius: 5px;
  user-select: none;
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

@media screen and (min-width: 801px) {
  #titulo {
    margin: 0;
    margin-top: 1%;
    margin-left: 1%;
    font-family: "Inter", sans-serif;
    text-align: left;
    color: #3d3d3d;
    font-size: 250%;
  }

  #div-labels {
    display: flex;
    align-items: flex-start;
  }

  #addContainer {
    display: flex;
    flex-direction: row;
    justify-content: center;
    width: 100%;
    height: 70vh;
  }

  #bottomContainer {
    display: flex;
    flex-direction: row;
    justify-content: center;
  }

  #col1 {
    width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
  }

  #col1 div {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  #col2 {
    width: 30%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: flex-start;
  }

  #col2 div {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  #wrapper {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
  }

  #wrapper-telefono {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    width: 100%;
  }

  #input-span {
    display: flex;
    flex-direction: row;
  }
  #input-span-telefono {
    display: flex;
    flex-direction: row;
    margin-left: 0;
  }

  #input-feature {
    display: flex;
    flex-direction: row;
  }

  .question {
    border: solid 2px #969696;
    border-left: 0;
    border-radius: 0px 5px 5px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .question-telefono {
    border: solid 2px #969696;
    border-left: 0;
    border-radius: 0px 5px 5px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    width: 13%;
  }
  .question-telefono .helpimg {
    width: 2.5vw;
    height: 2.5vh;
  }

  .question:hover ~ #help-question {
    display: none;
  }

  #help-question {
    position: absolute;
  }

  #input-span .helpimg {
    width: 2.5vw;
    height: 2.5vh;
    cursor: pointer;
  }

  .error {
    border-color: rgb(184, 48, 48);
  }

  #input-span img .error {
    width: 2.5vw;
    height: 2.5vh;
    cursor: pointer;
    color: red;
  }

  label {
    font-family: "Inter", sans-serif;
    margin-bottom: 4%;
  }

  input,
  textarea {
    font-size: medium;
    color: #000000;
    font-family: "Inter", sans-serif;
    width: 15vw;
    height: 5vh;
    border-radius: 5px 0px 0px 5px;
    background: #ffffff;
    border-top: solid 2px #969696;
    border-left: solid 2px #969696;
    border-bottom: solid 2px #969696;
    border-right: 0;
  }

  select {
    font-size: medium;
    color: #000000;
    font-family: "Inter", sans-serif;
    width: 18vw;
    height: 5.5vh;
    border-radius: 5px;
    background: #ffffff;
    border: solid 2px #969696;
  }

  button {
    background-color: #1089d4;
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px,
      rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px,
      rgba(0, 0, 0, 0.07) 0px 16px 16px;
    border-radius: 5px;
    width: 18vw;
    height: 5.8vh;
    font-family: "Inter", sans-serif;
    font-size: medium;
    color: #ffffff;
    text-align: center;
    cursor: pointer;
  }

  ::-webkit-input-placeholder {
    /* Chrome/Opera/Safari */
    color: #838383;
  }
  ::-moz-placeholder {
    /* Firefox 19+ */
    color: #838383;
  }
  :-ms-input-placeholder {
    /* IE 10+ */
    color: #838383;
  }
  :-moz-placeholder {
    /* Firefox 18- */
    color: #838383;
  }

  .hidden {
    visibility: hidden;
  }

  #input-feature {
    margin: auto;
    margin-left: 0.5rem;
    cursor: pointer;
  }
}

@media screen and (max-width: 800px) {
  #editar-usuarios-container {
    height: 100%;
  }

  #editar-usuarios-header-switch {
    display: flex;
    align-items: center;
    margin-right: 1%;
    margin-top: 1%;
  }

  #titulo {
    margin: 0;
    margin-top: 1%;
    margin-left: 1%;
    font-family: "Inter", sans-serif;
    text-align: left;
    color: #3d3d3d;
    font-size: 150%;
  }

  #div-labels {
    align-items: center;
    display: flex;
    justify-content: center;
  }

  #addContainer {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%; /*estaba en 70 */
  }

  #col1 {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-top: 1%;
  }
  #titulo-container {
    display: flex;
  }
  #col1 div {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  #col2 {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  #col2 div {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  #wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  #input-span {
    display: flex;
    width: 100%;
    flex-direction: row;
  }

  #input-span-telefono {
    display: flex;
    flex-direction: row;
    margin-left: 6%;
  }

  #input-feature {
    display: flex;
    flex-direction: row;
  }

  .question {
    border: solid 2px #969696;
    border-left: 0;
    border-radius: 0px 5px 5px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 3.7vh;
  }

  .question-telefono {
    border: solid 2px #969696;
    border-left: 0;
    border-radius: 0px 5px 5px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 3.7vh;
  }

  .question-telefono .helpimg {
    width: 5vw;
    height: 2.7vh;
    padding-right: 1%;
  }

  .question:hover ~ #help-question {
    display: none;
  }

  #help-question {
    position: absolute;
  }

  #input-span .helpimg {
    width: 5vw;
    height: 5vh;
    cursor: pointer;
    height: 2.7vh;
  }

  .error {
    border-color: rgb(184, 48, 48);
  }

  #input-span img .error {
    width: 2.5vw;
    height: 2.7vh;
    cursor: pointer;
    color: red;
  }

  label {
    font-family: "Inter", sans-serif;
    margin-bottom: 1%;
    font-size: 1rem;
  }

  input,
  textarea {
    font-size: medium;
    color: #000000;
    font-family: "Inter", sans-serif;
    width: 60vw;
    height: 3.7vh;
    background-color: rgb(0, 0, 0);
    background: #ffffff;
    border-top: solid 2px #969696;
    border-left: solid 2px #969696;
    border-bottom: solid 2px #969696;
    border-right: 0;
  }

  select {
    font-size: medium;
    color: #000000;
    font-family: "Inter", sans-serif;
    width: 65.5vw;
    height: fit-content;
    height: 3.7vh;
    border-radius: 5px;
    background: #ffffff;
    border: solid 2px #969696;
  }

  button {
    background-color: #1089d4;
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px,
      rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px,
      rgba(0, 0, 0, 0.07) 0px 16px 16px;
    border-radius: 5px;
    width: 35vw;
    height: 5.8vh;
    font-family: "Inter", sans-serif;
    font-size: medium;
    color: #ffffff;
    text-align: center;
    cursor: pointer;
  }

  ::-webkit-input-placeholder {
    /* Chrome/Opera/Safari */
    color: #838383;
  }
  ::-moz-placeholder {
    /* Firefox 19+ */
    color: #838383;
  }
  :-ms-input-placeholder {
    /* IE 10+ */
    color: #838383;
  }
  :-moz-placeholder {
    /* Firefox 18- */
    color: #838383;
  }

  .hidden {
    visibility: hidden;
  }

  #input-feature {
    position: relative;
    margin: auto;
    margin-left: 0.5rem;
    cursor: pointer;
  }
}
</style>