import React, { Component, Fragment } from "react";

import "../../assets/css/login.css";

class Login extends Component {
  render() {
    return (
      <Fragment>
        <div id="bg">
          <div id="caja">
            <div id="contenedor1">
              <div id="logo-container">
                <img
                  id="logo"
                  src="./../../../assets/img/logo.png"
                  alt="logo"
                />
              </div>
              <div id="maintitle1">
                <h1>
                  Sistema de Matricula <br />
                  Estudiantil
                </h1>
              </div>
              <form>
                <div id="user">
                  <section id="wrapper">
                    <section id="input-span">
                      <input
                        type="text"
                        name="nombre_usuario"
                        placeholder="Nombre de Usuario"
                      />
                    </section>
                  </section>
                </div>

                <div className="pw" id="pw">
                  <section id="wrapper">
                    <section id="input-span">
                      <input
                        // :type="type"
                        name="password"
                        placeholder="Contraseña"
                      />
                      <a
                        // :class="{ 'fa fa-eye-slash': !show, 'fa fa-eye': show }"
                        click="showPassword"
                      >
                        a
                      </a>
                    </section>
                  </section>
                </div>
                <div id="errortext">
                  <p
                  // v-if="
                  //   ((v$.user.password.$error && sent) || invalid) &&
                  //   ((v$.user.nombre_usuario.$error && sent) || invalid)
                  // "
                  >
                    Credenciales Incorrectas.
                  </p>
                  <p
                  // v-else-if="
                  //   !v$.user.password.$error && password_touched && !invalid
                  // "
                  ></p>
                </div>
                <div id="btnlog">
                  <button
                    type="submit"
                    // :disabled="
                    //   user.nombre_usuario.length < 1 || user.password.length < 1
                    // "
                  >
                    <div>Iniciar Sesión</div>
                  </button>
                </div>
                <div id="forgot"></div>
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
      </Fragment>
    );
  }
}

export default Login;
