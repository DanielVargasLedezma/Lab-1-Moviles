<template>
  <section>
    <section
      v-if="
        LoggedState && UsuarioLoggeado && UsuarioLoggeado.tipo_usuario === 1
      "
    >
      <div id="titulo-container">
        <h1 id="titulo">Creación de Ciclos</h1>
      </div>
      <div id="addContainer">
        <div id="col1">
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="nombre">Número de Ciclo</label>
              </div>
              <section id="input-span">
                <select
                  name="numero_ciclo"
                  id="rolCombo"
                  @change="handleValueChange"
                  @blur="touchInput"
                  :class="[{ error: v$.ciclo.numero_ciclo.$error }]"
                  :value="ciclo.numero_ciclo"
                >
                  <option value="default" selected="Selected" disabled>
                    Seleccionar
                  </option>
                  <option value="1">Primero</option>
                  <option value="2">Segundo</option>
                </select>
              </section>
              <span
                class="validation-error"
                v-if="v$.ciclo.numero_ciclo.$error"
              >
                Este campo es requerido
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="apellido">Año cuando se lleva curso</label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  name="year"
                  placeholder="Año del curso"
                  v-model="ciclo.year"
                  :class="[{ error: v$.ciclo.year.$error }]"
                  maxlength="4"
                  @input="touchInput"
                  @blur="touchInput"
                />
                <span
                  class="question"
                  :class="[{ error: v$.ciclo.year.$error }]"
                >
                  <img
                    class="helpimg"
                    name="year"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
              <span class="validation-error" v-if="v$.ciclo.year.$error">
                Requerido, ser numérico de 4 dígitos.
              </span>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="nombreUsuario">¿Ciclo activo?</label>
              </div>
              <section id="input-span">
                <select
                  name="ciclo_activo"
                  id="rolCombo"
                  @change="handleValueChange"
                  @blur="touchInput"
                  :class="[{ error: v$.ciclo.ciclo_activo.$error }]"
                  :value="ciclo.ciclo_activo"
                >
                  <option value="default" selected="Selected" disabled>
                    Seleccionar
                  </option>
                  <option value="1">Si</option>
                  <option value="0">No</option>
                </select>
              </section>
              <span
                class="validation-error"
                v-if="v$.ciclo.ciclo_activo.$error"
              >
                Este campo es requerido
              </span>
            </section>
          </div>
        </div>
        <div id="col2">
          <div>
            <section id="wrapper" class="select">
              <div id="div-labels">
                <label for="fechaVencimiento">Fecha de Inicio</label>
              </div>
              <div class="fecha_vencimiento">
                <div id="div-labels"></div>
                <section id="input-span">
                  <input
                    id="fechaVencimiento"
                    name="fecha_inicio"
                    class="input-3"
                    type="date"
                    :min="ciclo.year + '-01-01'"
                    :disabled="ciclo.year === '' || v$.ciclo.year.$error"
                    @blur="touchInput"
                    @change="resetFinal"
                    v-model="ciclo.fecha_inicio"
                    :class="[{ error: v$.ciclo.fecha_inicio.$error }]"
                  />
                  <span
                    class="question"
                    :class="[{ error: v$.ciclo.fecha_inicio.$error }]"
                  >
                    <img
                      class="helpimg"
                      name="fecha_inicio"
                      @click="showHelp"
                      src="../../assets/svg/questionsign.svg"
                      alt="help"
                    />
                  </span>
                </section>
                <span
                  class="validation-error"
                  v-if="v$.ciclo.fecha_inicio.$error"
                >
                  Este campo es requerido
                </span>
              </div>
            </section>
          </div>
          <div>
            <section id="wrapper" class="select">
              <div id="div-labels">
                <label for="proyecto">Fecha de Finalización</label>
              </div>
              <div class="fecha_vencimiento">
                <div id="div-labels"></div>
                <section id="input-span">
                  <input
                    type="date"
                    id="fechaVencimiento"
                    name="fecha_finalizacion"
                    class="input-3"
                    :min="min_despues"
                    :disabled="ciclo.fecha_inicio === ''"
                    @click="setMinDespues"
                    @blur="touchInput"
                    v-model="ciclo.fecha_finalizacion"
                    :class="[{ error: v$.ciclo.fecha_finalizacion.$error }]"
                  />
                  <span
                    class="question"
                    :class="[{ error: v$.ciclo.fecha_finalizacion.$error }]"
                  >
                    <img
                      class="helpimg"
                      name="fecha_finalizacion"
                      @click="showHelp"
                      src="../../assets/svg/questionsign.svg"
                      alt="help"
                    />
                  </span>
                </section>
                <span
                  class="validation-error"
                  v-if="v$.ciclo.fecha_finalizacion.$error"
                >
                  Este campo es requerido
                </span>
              </div>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <label style="visibility: hidden">Hola</label>
              <button type="submit" @click="editarCiclo">Editar Ciclo</button>
            </section>
          </div>
        </div>
      </div>
    </section>
    <section v-else></section>
  </section>
</template>

<script>
import { required, numeric, minLength } from "@vuelidate/validators";
import { mapMutations, mapGetters } from "vuex";
import useValidate from "@vuelidate/core";
import swal from "sweetalert2";

import cicloController from "../../controllers/cicloController.js";
import Ciclo from "@/models/ciclo.js";

export default {
  data() {
    return {
      v$: useValidate(),
      ciclo: new Ciclo(),
      min_despues: "",
    };
  },
  validations() {
    return {
      ciclo: {
        id_ciclo: { required, numeric },
        numero_ciclo: { required, numeric },
        year: { required, numeric, minLength: minLength(4) },
        fecha_inicio: { required },
        fecha_finalizacion: { required },
        ciclo_activo: { required, numeric },
      },
    };
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      LoggedState: "LoginModule/LoggedState",
      Token: "LoginModule/Token",

      GET_CICLO_ACTUAL: "TableCicloModule/GET_CICLO_ACTUAL",
    }),
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    this.ciclo.id_ciclo = this.GET_CICLO_ACTUAL.id_ciclo;
    this.ciclo.numero_ciclo = this.GET_CICLO_ACTUAL.numero_ciclo;
    this.ciclo.year = this.GET_CICLO_ACTUAL.year;
    this.ciclo.fecha_inicio = this.GET_CICLO_ACTUAL.fecha_inicio.substring(
      0,
      10
    );
    this.ciclo.fecha_finalizacion =
      this.GET_CICLO_ACTUAL.fecha_finalizacion.substring(0, 10);
    this.ciclo.ciclo_activo = this.GET_CICLO_ACTUAL.ciclo_activo;
  },
  methods: {
    ...mapMutations({
      LogOut: "LoginModule/logout",
    }),
    async editarCiclo() {
      await this.v$.$validate();

      if (!this.v$.$error) {
        await cicloController
          .editarCiclo(this.ciclo, this.Token)
          .then((response) => {
            if (response === 204) {
              swal.fire(
                "¡Ciclo Editado!",
                "La ciclo ha sido editado con éxito.",
                "success"
              );
              this.$router.push("/inicio/ciclos");
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
        case "year":
          swal.fire(
            "Año de la Carrera",
            "En este apartado debe ingresar el año del ciclo a ingresar. Debe ser un número de cuatro dígitos",
            "info"
          );
          break;
        case "titulo":
          swal.fire(
            "Título de la Carrera",
            "En este apartado debe ingresar el título de la ciclo a ingresar.",
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
        case "numero_ciclo":
          this.v$.ciclo.numero_ciclo.$touch();
          break;
        case "year":
          this.v$.ciclo.year.$touch();

          this.ciclo.fecha_inicio = "";
          this.ciclo.fecha_finalizacion = "";
          break;
        case "fecha_inicio":
          this.v$.ciclo.fecha_inicio.$touch();
          break;
        case "fecha_finalizacion":
          this.v$.ciclo.fecha_finalizacion.$touch();
          break;
        case "ciclo_activo":
          this.v$.ciclo.ciclo_activo.$touch();
          break;
      }
    },
    handleValueChange: function (e) {
      switch (e.target.name) {
        case "numero_ciclo":
          this.ciclo.numero_ciclo = parseInt(e.target.value);
          break;
        case "ciclo_activo":
          this.ciclo.ciclo_activo = parseInt(e.target.value);
          break;
      }
    },
    setMinDespues: function () {
      var arrayMeses = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

      var digitos = this.ciclo.fecha_inicio.split("-");

      if (digitos.length === 0) {
        return "";
      }

      var mes_despues = parseInt(digitos[1]) + 6;
      var año_despues = parseInt(digitos[0]);
      var dia_despues = parseInt(digitos[2]);

      if (mes_despues > 12) {
        año_despues += 1;
        mes_despues = mes_despues - 12;
      }

      if (arrayMeses[mes_despues - 1] < dia_despues) {
        dia_despues = arrayMeses[mes_despues - 1];
      }

      if (mes_despues < 10) {
        mes_despues = "0" + mes_despues;
      }

      if (dia_despues < 10) {
        dia_despues = "0" + dia_despues;
      }

      this.min_despues = año_despues + "-" + mes_despues + "-" + dia_despues;
    },
  },
  resetFinal: function () {
    this.ciclo.fecha_finalizacion = "";
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