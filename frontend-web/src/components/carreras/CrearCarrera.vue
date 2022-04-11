<template>
  <section>
    <section
      v-if="
        LoggedState && UsuarioLoggeado && UsuarioLoggeado.tipo_usuario === 1
      "
    >
      <div id="titulo-container">
        <h1 id="titulo">Creación de Carreras</h1>
      </div>
      <div id="addContainer">
        <div id="col1">
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="codigo_carrera">Código de la Carrera</label>
              </div>

              <section id="input-span">
                <input
                  type="text"
                  placeholder="Código de Carera"
                  v-model="carrera.codigo_carrera"
                  :class="[{ error: v$.carrera.codigo_carrera.$error && sent }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.carrera.codigo_carrera.$error && sent }]"
                >
                  <img
                    class="helpimg"
                    :class="[
                      { error: v$.carrera.codigo_carrera.$error && sent },
                    ]"
                    name="codigo_carrera"
                    @click="showHelp"
                    src="@/assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="apellido">Apellidos</label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Apellidos"
                  v-model="carrera.apellidos"
                  :class="[{ error: v$.carrera.apellidos.$error && sent }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.carrera.apellidos.$error && sent }]"
                >
                  <img
                    class="helpimg"
                    name="apellidos"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="nombreUsuario">Nombre de Usuario</label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Nombre de Usuario"
                  v-model="carrera.nombre_usuario"
                  :class="[{ error: v$.carrera.nombre_usuario.$error && sent }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.carrera.nombre_usuario.$error && sent }]"
                >
                  <img
                    class="helpimg"
                    name="nombre_usuario"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="cedula">Cédula</label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Cédula"
                  v-model="carrera.cedula"
                  :class="[{ error: v$.carrera.cedula.$error && sent }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.carrera.cedula.$error && sent }]"
                >
                  <img
                    class="helpimg"
                    name="cedula"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <div id="div-labels">
                <label for="correoElectronico">Correo Electrónico</label>
              </div>
              <section id="input-span">
                <input
                  type="text"
                  placeholder="Correo Electrónico"
                  v-model="carrera.correo"
                  :class="[{ error: v$.carrera.correo.$error && sent }]"
                />
                <span
                  class="question"
                  :class="[{ error: v$.carrera.correo.$error && sent }]"
                >
                  <img
                    class="helpimg"
                    name="correo"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
              </section>
            </section>
          </div>
        </div>
        <div id="col2">
          <div>
            <section id="wrapper" class="select">
              <div id="div-labels">
                <label for="rol">Rol</label>
              </div>
              <select
                name="rol"
                id="rolCombo"
                @change="handleValueChange"
                :class="[{ error: v$.carrera.id_rol.$error && sent }]"
              >
                <option value="default" selected="Selected" disabled>
                  Seleccionar
                </option>
                <option value="3">Gestor(a)</option>
                <option value="2">Supervisor(a)</option>
                <option value="1">Administrador(a)</option>
              </select>
            </section>
          </div>
          <div>
            <section id="wrapper" class="select">
              <div id="div-labels">
                <label for="proyecto">Proyecto</label>
              </div>
              <select
                name="proyecto"
                id="proyectoCombo"
                @change="handleValueChange"
                :class="[{ error: v$.carrera.id_proyecto.$error && sent }]"
              >
                <option value="default" selected="Selected" disabled>
                  Seleccionar
                </option>
                <option
                  v-for="(proyecto, index) in proyectos"
                  :key="index"
                  :value="proyecto.id_proyecto"
                >
                  {{ proyecto.nombre_proyecto }}
                </option>
              </select>
            </section>
          </div>

          <div>
            <section id="wrapper-telefono">
              <div id="div-labels">
                <label for="telefono">Teléfono</label>
              </div>
              <section id="input-span-telefono">
                <input
                  type="tel"
                  class="form-control"
                  id="telephone"
                  placeholder="Teléfono"
                  v-model="carrera.telefono1"
                  :class="[{ error: v$.carrera.telefono1.$error && sent }]"
                />
                <span
                  class="question-telefono"
                  :class="[{ error: v$.carrera.telefono1.$error && sent }]"
                >
                  <img
                    class="helpimg"
                    name="telefono1"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
                <span id="input-feature" @click="mostrarCampoExtra"
                  ><img src="./../../assets/svg/addsign.svg" alt=""
                /></span>
              </section>
            </section>
          </div>
          <div :class="{ hidden: campoOculto }">
            <section id="wrapper-telefono">
              <div id="div-labels">
                <label for="telefono">Teléfono Adicional</label>
              </div>
              <section id="input-span-telefono">
                <input
                  type="tel"
                  class="form-control"
                  id="telephone2"
                  placeholder="Teléfono Adicional"
                  v-model="carrera.telefono2"
                  :class="[{ error: v$.carrera.telefono2.$error && sent }]"
                />
                <span
                  class="question-telefono"
                  :class="[{ error: v$.carrera.telefono2.$error && sent }]"
                >
                  <img
                    class="helpimg"
                    name="telefono2"
                    @click="showHelp"
                    src="../../assets/svg/questionsign.svg"
                    alt="help"
                  />
                </span>
                <span id="input-feature" @click="esconderCampoExtra"
                  ><img src="./../../assets/svg/removesign.svg" alt=""
                /></span>
              </section>
            </section>
          </div>
          <div>
            <section id="wrapper">
              <label style="visibility: hidden">Hola</label>
              <button type="submit" @click="insertarUsuario">
                Crear Usuario
              </button>
            </section>
          </div>
        </div>
      </div>
    </section>
    <section v-else></section>
  </section>
</template>

<script>
import { required, helpers } from "@vuelidate/validators";
import { mapMutations, mapGetters } from "vuex";
import useValidate from "@vuelidate/core";
import swal from "sweetalert2";

import Carrera from "@/models/carrera.js";

const alpha_with_spaces = helpers.regex(/^[\D\s]+$/);

const alpha_with_spaces_special_and_underscore = helpers.regex(/^[\w-\s]+$/);

export default {
  data() {
    return {
      v$: useValidate(),
      carrera: new Carrera(),
      proyectos: [],
      campoOculto: true,
      sent: false,
      iti: null,
      iti2: null,
    };
  },
  validations() {
    return {
      carrera: {
        codigo_carrera: { required, alpha_with_spaces },
        nombre: {
          required,
          alpha_with_spaces_special_and_underscore,
        },
        titulo: {
          required,
          alpha_with_spaces,
        },
      },
    };
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      LoggedState: "LoginModule/LoggedState",
      Token: "LoginModule/Token",
    }),
  },
  async mounted() {
    if (this.UsuarioLoggeado && this.UsuarioLoggeado.tipo_usuario !== 1) {
      this.$router.push("/inicio");
    }

    this.campoOculto = true;
  },
  methods: {
    ...mapMutations({
      LogOut: "LoginModule/logout",
    }),
    showHelp(e) {
      switch (e.target.name) {
        case "nombre":
          swal(
            "Nombre",
            "En este apartado debe ingresar el nombre del usuario a ingresar.\nEn caso de tener segundo nombre, tambien puede ingresarlo.",
            "info"
          );
          break;
        case "nombre_usuario":
          swal(
            "Nombre de Usuario",
            "En este apartado debe ingresar el nombre de usuario que sera utilizado en el sistema. \n \nImportante: \nEl nombre de usuario debe contar con un minimo de 8 caracteres, incluyendo letras y numeros.",
            "info"
          );
          break;
        case "correo":
          swal(
            "Correo Electrónico",
            "En este apartado debe ingresar el correo electrónico personal del usuario.",
            "info"
          );
          break;
        case "apellidos":
          swal(
            "Apellidos",
            "En este apartado debe ingresar los apellidos del usuario.\n \nNota: \nPuede ingresar los dos apellidos.",
            "info"
          );
          break;
        case "cedula":
          swal(
            "Cédula",
            "En este apartado debe ingresar el numero de cedula del usuario.\n \nNota: \nNo utilice guiones.",
            "info"
          );
          break;
        case "telefono1":
          swal(
            "Teléfono",
            "En este apartado debe ingresar el numero de telefono del usuario.\n \nNota: \nEn caso de querer agregar otro numero, puede hacerlo utilizando el icono con el simbolo de +.",
            "info"
          );
          break;
        case "telefono2":
          swal(
            "Teléfono Adicional",
            "En este apartado puede ingresar un segundo numero de telefono para el usuario.\n \nNota: \nEste apartado es opcional.",
            "info"
          );
          break;
        default:
          console.log("Switch error");
      }
    },
    handleValueChange(e) {
      if (e.target.name === "rol") {
        this.user.id_rol = e.target.value;
      } else if (e.target.name === "proyecto") {
        this.user.id_proyecto = e.target.value;
      }
      // console.log(e.target.name);
    },
    async insertarUsuario() {
      //Formato de telefono
      const telephone1 = this.user.telefono1;
      this.user.telefono1 =
        "+" + this.iti.activeItem.dataset.dialCode + " " + telephone1;
      var telephone2 = "";
      if (!this.campoOculto) {
        telephone2 = this.user.telefono2;
        this.user.telefono2 =
          "+" + this.iti2.activeItem.dataset.dialCode + " " + telephone2;
      }
      //Formato de telefono
      await this.v$.$validate();
      this.sent = true;

      if (!this.v$.$error) {
        await UserController.insertarUsuarios(this.user, this.Token)
          .then((user) => {
            this.user.id = user.id_usuario;
            TelephoneController.insertarTelefonosEnUsuarios(
              this.user,
              this.Token
            )
              .then((res) => {
                // console.log(res);
                if (res) {
                  swal(
                    "¡Usuario Registrado!",
                    "El usuario ha sido registrado con éxito",
                    "success"
                  );

                  this.$router.push("/inicio-admin/usuarios");
                }
              })
              .catch((error) => {
                console.error(error);
                swal("¡Registro fallido!", "Ha sucedido un error", "error");
              });
          })
          .catch((error) => {
            console.error(error);

            var error1 = "";
            var error2 = "";
            var error3 = "";

            if (error.data.errors.nombre_usuario) {
              error1 = error.data.errors.nombre_usuario;
            }
            if (error.data.errors.correo) {
              error2 = error.data.errors.correo;
            }
            if (error.data.errors.cedula) {
              error3 = error.data.errors.cedula;
            }

            swal(
              "¡Registro fallido!",
              `Se encontraron los siguientes errores:
              ${error1} \n ${error2} \n ${error3}`,
              "error"
            );
          });
      }
      this.user.telefono1 = telephone1;
      this.user.telefono2 = telephone2;
    },
    mostrarCampoExtra() {
      // console.log("a");
      if (this.campoOculto) {
        this.campoOculto = !this.campoOculto;
      }
    },
    esconderCampoExtra() {
      if (!this.campoOculto) {
        this.campoOculto = !this.campoOculto;
        this.user.telefono2 = null;
      }
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap");

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

  input {
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

  input {
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