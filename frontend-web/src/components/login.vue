<template>
  <div id="bg">
    <div id="caja">
      <div id="contenedor1">
        <div id="logo-container">
          <img id="logo" src="./../assets/img/logo.png" alt="logo" />
        </div>
        <div id="maintitle1">
          <h1>
            Sistema de Matricula <br />
            Estudiantil
          </h1>
        </div>
        <form @submit.prevent="manejoDatos">
          <div id="user">
            <section id="wrapper">
              <section id="input-span">
                <input
                  type="text"
                  name="cedula"
                  placeholder="Cedula"
                  v-model="user.cedula"
                  @change="checkInput"
                  :class="[
                    {
                      error: (v$.user.cedula.$error && sent) || invalid,
                      correct:
                        !v$.user.cedula.$error &&
                        username_touched &&
                        sent &&
                        !invalid,
                    },
                  ]"
                />
              </section>
            </section>
          </div>

          <div class="pw" id="pw">
            <section id="wrapper">
              <section id="input-span">
                <input
                  :type="type"
                  name="password"
                  placeholder="Contraseña"
                  v-model="user.password"
                  @change="checkInput"
                  :class="[
                    {
                      error: (v$.user.password.$error && sent) || invalid,
                      correct:
                        !v$.user.password.$error &&
                        password_touched &&
                        sent &&
                        !invalid,
                    },
                  ]"
                />
                <font-awesome-icon
                  v-if="show"
                  style="
                    cursor: pointer;
                    margin-top: 0.9rem;
                    margin-left: 0.2rem;
                    border: none;
                    color: #1089d4;
                  "
                  icon="eye"
                  @click="showPassword"
                />
                <font-awesome-icon
                  v-else
                  style="
                    cursor: pointer;
                    margin-top: 0.9rem;
                    margin-left: 0.2rem;
                    border: none;
                    color: #1089d4;
                  "
                  icon="eye-slash"
                  @click="showPassword"
                />
              </section>
            </section>
          </div>
          <div id="forgot">
            <div class="radio">
              <input
                type="radio"
                id="radio-1"
                name="login-type"
                value="1"
                v-model="user.tipo_usuario"
              />
              <label for="radio-1" class="radio-label">Administrador</label
              ><br />
            </div>
            <div class="radio">
              <input
                type="radio"
                id="radio-2"
                name="login-type"
                value="2"
                v-model="user.tipo_usuario"
              />
              <label for="radio-2" class="radio-label">Matriculador</label
              ><br />
            </div>
            <div class="radio">
              <input
                type="radio"
                id="radio-3"
                name="login-type"
                value="3"
                v-model="user.tipo_usuario"
              />
              <label for="radio-3" class="radio-label">Profesor</label>
            </div>
            <div class="radio">
              <input
                type="radio"
                id="radio-4"
                name="login-type"
                value="4"
                v-model="user.tipo_usuario"
              />
              <label for="radio-4" class="radio-label">Estudiante</label>
            </div>
          </div>
          <div id="errortext">
            <p
              v-if="
                ((v$.user.password.$error && sent) || invalid) &&
                ((v$.user.cedula.$error && sent) || invalid)
              "
            >
              Credenciales Incorrectas.
            </p>
            <p
              v-else-if="
                !v$.user.password.$error && password_touched && !invalid
              "
            ></p>
          </div>
          <div id="btnlog">
            <button
              type="submit"
              :disabled="
                user.cedula.length < 1 ||
                user.password.length < 1 ||
                user.tipo_usuario === 0
              "
            >
              <div>Iniciar Sesión</div>
            </button>
          </div>
        </form>
      </div>
      <div id="contenedor2">
        <div id="maintitle2">
          <h1>
            Sistema de Matricula <br />
            Estudiantil
          </h1>
        </div>
        <div id="image">
          <img
            id="fronticon"
            src="./../assets/svg/frontpage.svg"
            alt="frontpage"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, numeric, helpers } from "@vuelidate/validators";
import { mapMutations, mapGetters } from "vuex";
import useValidate from "@vuelidate/core";

import User from "../models/usuario.js";
import UserController from "../controllers/userController.js";

const alpha_with_spaces_special_and_underscore = helpers.regex(/^[\w-\s]+$/);

export default {
  data() {
    return {
      show: false,
      v$: useValidate(),
      user: new User(),
      sent: false,
      username_touched: false,
      password_touched: false,
      invalid: false,
      type: "password",
      btnText: "Mostrar",
    };
  },
  validations() {
    return {
      user: {
        cedula: { required, alpha_with_spaces_special_and_underscore },
        password: { required },
        tipo_usuario: { required, numeric },
      },
    };
  },
  mounted() {
    if (this.LoggedState) {
      switch (this.UsuarioLoggeado.tipo_usuario) {
        case 1:
          this.$router.push("/inicio-admin");
          break;
        case 2:
          this.$router.push("/inicio-super");
          break;
        case 3:
          this.$router.push("/inicio-gestor");
          break;
        case 4:
          this.$router.push("/inicio-gestor");
          break;
      }
    }
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: ["LoginModule/UsuarioLoggeado"],
      LoggedState: ["LoginModule/LoggedState"],
    }),
  },
  methods: {
    ...mapMutations({
      setUserLogged: "LoginModule/setUserLogged",
      setToken: "LoginModule/setToken",
      setLoggedState: "LoginModule/setLoggedState",
    }),
    showPassword() {
      if (this.type === "password") {
        this.type = "text";
        this.btnText = "Ocultar";
        this.show = true;
      } else {
        this.type = "password";
        this.btnText = "Mostrar";
        this.show = false;
      }
    },
    switchVisibility() {
      this.passwordFieldType =
        this.passwordFieldType === "password" ? "text" : "password";
    },
    async manejoDatos() {
      this.sent = true;
      this.v$.$validate();

      if (!this.v$.$error) {
        switch (this.UsuarioLoggeado.tipo_usuario) {
          case 1:
            this.$router.push("/inicio-admin");
            break;
          case 2:
            this.$router.push("/inicio-super");
            break;
          case 3:
            this.$router.push("/inicio-gestor");
            break;
          case 4:
            this.$router.push("/inicio-gestor");
            break;
        }
        await UserController.login(this.user)
          .then((res) => {
            this.user.id = res.user.id_usuario;
            this.user.nombre = res.user.nombre;
            this.user.apellidos = res.user.apellidos;
            this.user.cedula = res.user.cedula;
            this.user.estado = res.user.estado;
            this.user.correo = res.user.correo;
            this.user.cedula = res.user.cedula;
            this.user.id_rol = res.user.rol.id_rol;
            this.user.id_proyecto = res.user.proyecto.id_proyecto;
            this.user.telefono1 = res.user.telefonos[0];
            this.user.contraseña_cambiada = res.user.contraseña_cambiada;

            if (res.user.telefonos.length > 1) {
              this.user.telefono2 = res.user.telefonos[1];
            }

            this.setUserLogged(this.user);
            this.setToken(res.token);
            this.setLoggedState(true);

            switch (this.UsuarioLoggeado.id_rol) {
              case 1:
                this.$router.push("/inicio-admin");
                break;
              case 2:
                this.$router.push("/inicio-super");
                break;
              case 3:
                this.$router.push("/inicio-gestor");
                break;
            }
          })
          .catch((err) => {
            console.error(err);
            // swal("¡Error al autentificarse!", `${err.data.message}`, "error");
            // this.v$.user.cedula.$dirty = true;
            // this.v$.user.password.$dirty = true;
            this.invalid = true;
          });
      }
    },
    checkInput(e) {
      switch (e.target.name) {
        case "cedula":
          this.v$.user.cedula.$touch();
          this.username_touched = true;
          this.invalid = false;
          break;
        case "password":
          this.v$.user.password.$touch();
          this.password_touched = true;
          this.invalid = false;
          break;
      }
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Cabin:wght@700&display=swap");
.btn {
  background-color: white;
  border: none;
  color: #1089d4;
  padding: 12px 16px;
  font-size: 16px;
  cursor: pointer;
}
.pw {
  margin-left: 1rem;
}
#bg {
  display: flex;
  flex-direction: row;
  justify-content: center;
  background-image: url("./../assets/img/login-bg.png");
  width: 100%;
  height: 100vh;
  background-position: center;
  background-size: cover;
  padding-left: 3%;
  padding-right: 3%;
  padding-bottom: 3%;
  padding-top: 3%;
  box-sizing: border-box;
}
@media screen and (max-width: 600px) {
  #caja {
    margin: 0;
    padding: 0;
    background: rgb(255, 255, 255);
    background: linear-gradient(90deg, rgba(255, 255, 255, 1) 100%);
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
    border-radius: 35px;
  }
  #contenedor1 {
    width: 80%;
    display: flex;
    flex-direction: column;
    justify-content: left;
  }
  #contenedor2 {
    display: none;
    width: 50%;
    flex-direction: column;
    justify-content: center;
  }

  #logo-container {
    display: flex;
    justify-content: center;
  }
  #logo {
    margin-top: 15%;
    margin-bottom: 10%;
    width: 80%;
    height: auto;
  }

  #maintitle1 h1 {
    font-family: "Cabin", sans-serif;
    color: #11234e;
    text-align: center;
    font-size: 150%;
  }
  #maintitle2 h1 {
    display: none;
  }

  #fronticon {
    display: none;
    width: 65%;
    height: auto;
  }

  #image {
    display: flex;
    flex-direction: row;
    justify-content: center;
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

  form {
    margin-top: 5%;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    height: 50vh;
  }

  #user {
    display: flex;
    justify-content: center;
    margin-top: 4vw;
    margin-bottom: 2vw;
  }
  #pw {
    margin-top: 2vw;
    display: flex;
    justify-content: center;
    margin-bottom: 2vw;
  }
  #btnlog {
    margin-top: 2vw;
    display: flex;
    justify-content: center;
    margin-bottom: 2vw;
  }
  #forgot {
    display: flex;
    justify-content: center;
  }
  #hidebr2 {
    display: none;
  }
  #forgot {
    margin-top: 2vw;
    color: #4a4a4a;
    font-family: "Cabin", sans-serif;
    font-size: smaller;
  }
  #btnlog button {
    background-color: #1089d4;
    cursor: pointer;
    border-radius: 5px;
    width: 40vw;
    height: 5vh;
    margin-right: 0.7%;
  }

  #btnlog button:disabled {
    background-color: #5595bd;
    cursor: not-allowed;
  }
  #btnlog button div {
    font-family: "Cabin", sans-serif;
    font-size: medium;
    color: #ffffff;
  }

  #wrapper {
    display: flex;
    flex-direction: column;
  }

  #input-span {
    display: flex;
    flex-direction: row;
  }

  #input-feature {
    display: flex;
    flex-direction: row;
  }

  #question {
    border: solid 2px #969696;
    border-left: 0;
    border-radius: 0px 5px 5px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  #question:hover ~ #help-question {
    display: none;
  }

  #help-question {
    position: absolute;
  }

  #input-span img {
    width: 2.5vw;
    height: 2.5vh;
    cursor: pointer;
  }

  #errortext {
    display: flex;
    justify-content: center;
    color: #da2020;
  }

  input[type="password"],
  input[type="text"] {
    font-size: medium;
    color: #000000;
    font-family: "Inter", sans-serif;
    width: 40vw;
    height: 5vh;
    border-radius: 5px 5px 5px 5px;
    background: #ffffff;
    border: solid 2px #969696;
  }

  .radio {
    margin: 0.5rem;
  }
  .radio input[type="radio"] {
    position: absolute;
    opacity: 0;
  }
  .radio input[type="radio"] + .radio-label:before {
    content: "";
    background: #f4f4f4;
    border-radius: 100%;
    border: 1px solid #b4b4b4;
    display: inline-block;
    width: 1.4em;
    height: 1.4em;
    position: relative;
    top: -0.2em;
    margin-right: 1em;
    vertical-align: top;
    cursor: pointer;
    text-align: center;
    transition: all 250ms ease;
  }
  .radio input[type="radio"]:checked + .radio-label:before {
    background-color: #3197ee;
    box-shadow: inset 0 0 0 4px #f4f4f4;
  }
  .radio input[type="radio"]:focus + .radio-label:before {
    outline: none;
    border-color: #3197ee;
  }
  .radio input[type="radio"]:disabled + .radio-label:before {
    box-shadow: inset 0 0 0 4px #f4f4f4;
    border-color: #b4b4b4;
    background: #b4b4b4;
  }
  .radio input[type="radio"] + .radio-label:empty:before {
    margin-right: 0;
  }
}

@media screen and (min-width: 601px) {
  #caja {
    margin: 0;
    padding: 0;
    background: rgb(255, 255, 255);
    background: linear-gradient(
      90deg,
      rgba(255, 255, 255, 1) 50%,
      rgba(245, 245, 245, 1) 50%
    );
    width: 100%;
    height: 85vh;
    display: flex;
    flex-direction: row;
    justify-content: center;
    border-radius: 35px;
  }
  #contenedor1 {
    width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: left;
  }
  #contenedor2 {
    width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  #logo {
    margin-top: 2rem;
    margin-left: 2rem;
    width: 40%;
    height: auto;
  }

  #maintitle2 h1 {
    font-family: "Cabin", sans-serif;
    color: #071e55;
    text-align: center;
    font-size: 250%;
  }
  #maintitle1 h1 {
    display: none;
  }

  #fronticon {
    width: 65%;
    height: auto;
  }

  #image {
    display: flex;
    flex-direction: row;
    justify-content: center;
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

  form {
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    height: 50vh;
  }

  #user {
    display: flex;
    justify-content: center;
    margin-top: 4vw;
    margin-bottom: 2vw;
  }
  #pw {
    margin-top: 2vw;
    display: flex;
    justify-content: center;
    margin-bottom: 2vw;
  }
  #btnlog {
    margin-top: 2vw;
    display: flex;
    justify-content: center;
    margin-bottom: 2vw;
  }
  #forgot {
    display: flex;
    justify-content: center;
  }
  #hidebr2 {
    display: none;
  }
  #forgot a {
    margin-top: 2vw;
    color: #4a4a4a;
    font-family: "Cabin", sans-serif;
    font-size: smaller;
  }
  #btnlog button {
    background-color: #1089d4;
    cursor: pointer;
    border-radius: 5px;
    width: 37.5%;
    height: 200%;
    margin-right: 0.7%;
  }

  #btnlog button:disabled {
    background-color: #5595bd;
    cursor: not-allowed;
  }
  #btnlog button div {
    font-family: "Cabin", sans-serif;
    font-size: medium;
    color: #ffffff;
  }

  #wrapper {
    display: flex;
    flex-direction: column;
  }

  #input-span {
    display: flex;
    flex-direction: row;
  }

  #input-feature {
    display: flex;
    flex-direction: row;
  }

  #question {
    border: solid 2px #969696;
    border-left: 0;
    border-radius: 0px 5px 5px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  #question:hover ~ #help-question {
    display: none;
  }

  #help-question {
    position: absolute;
  }

  #input-span img {
    width: 2.5vw;
    height: 2.5vh;
    cursor: pointer;
  }

  #errortext {
    display: flex;
    justify-content: center;
    color: #da2020;
  }

  input[type="password"],
  input[type="text"] {
    font-size: medium;
    color: #000000;
    font-family: "Inter", sans-serif;
    width: 17.5vw;
    height: 5vh;
    border-radius: 5px 5px 5px 5px;
    background: #ffffff;
    border: solid 2px #969696;
  }

  .radio {
    margin: 0.5rem;
  }
  .radio input[type="radio"] {
    position: absolute;
    opacity: 0;
  }
  .radio input[type="radio"] + .radio-label:before {
    content: "";
    background: #f4f4f4;
    border-radius: 100%;
    border: 1px solid #b4b4b4;
    display: inline-block;
    width: 1.4em;
    height: 1.4em;
    position: relative;
    top: -0.2em;
    margin-right: 1em;
    vertical-align: top;
    cursor: pointer;
    text-align: center;
    transition: all 250ms ease;
  }
  .radio input[type="radio"]:checked + .radio-label:before {
    background-color: #3197ee;
    box-shadow: inset 0 0 0 4px #f4f4f4;
  }
  .radio input[type="radio"]:focus + .radio-label:before {
    outline: none;
    border-color: #3197ee;
  }
  .radio input[type="radio"]:disabled + .radio-label:before {
    box-shadow: inset 0 0 0 4px #f4f4f4;
    border-color: #b4b4b4;
    background: #b4b4b4;
  }
  .radio input[type="radio"] + .radio-label:empty:before {
    margin-right: 0;
  }
}
</style>
