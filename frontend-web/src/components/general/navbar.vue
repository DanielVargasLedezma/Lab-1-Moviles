<template>
  <div id="navbar">
    <div id="half1">
      <div id="logonav">
        <router-link to="/inicio">
          <img src="./../../assets/img/enroll_logo.png" alt="logo"
        /></router-link>
      </div>
      <div id="SSC">
        <!-- <span style="color: black">Sistema de </span><br />Seguimiento de Cobros -->
      </div>
      <div id="menu">
        <router-link
          active-class="active-link"
          style="text-decoration: none; color: inherit"
          to="/inicio/usuarios"
        >
          <div
            id="usuarios"
            tabindex="1"
            v-if="UsuarioLoggeado.tipo_usuario === 1"
          >
            <img src="./../../assets/svg/users.svg" alt="users" />
            <div id="txt">Usuarios</div>
          </div>
        </router-link>

        <div><br /><br /></div>

        <router-link
          active-class="active-link"
          style="text-decoration: none; color: inherit"
          to="/inicio/grupos-asignados"
        >
          <div
            id="clientes"
            tabindex="1"
            v-if="UsuarioLoggeado.tipo_usuario === 3"
          >
            <img src="./../../assets/svg/enroll.svg" alt="users" />
            <div id="txt">Grupos Asignados</div>
          </div>
        </router-link>

        <router-link
          active-class="active-link"
          style="text-decoration: none; color: inherit"
          to="/inicio/historial-academico/alumno"
        >
          <div
            id="clientes"
            tabindex="1"
            v-if="UsuarioLoggeado.tipo_usuario === 4"
          >
            <img src="./../../assets/svg/enroll.svg" alt="users" />
            <div id="txt">Historial Matrícula</div>
          </div>
        </router-link>

        <router-link
          active-class="active-link"
          style="text-decoration: none; color: inherit"
          to="/inicio/matricula"
        >
          <div
            id="clientes"
            tabindex="1"
            v-if="UsuarioLoggeado.tipo_usuario === 2"
          >
            <img src="./../../assets/svg/enroll.svg" alt="users" />
            <div id="txt">Matricula</div>
          </div>
        </router-link>

        <router-link
          active-class="active-link"
          style="text-decoration: none; color: inherit"
          to="/inicio/carreras"
        >
          <div
            id="usuarios"
            tabindex="2"
            v-if="UsuarioLoggeado.tipo_usuario === 1"
          >
            <img src="./../../assets/svg/career.svg" alt="users" />
            <div id="txt">Carreras</div>
          </div></router-link
        >
        <div><br /><br /></div>

        <router-link
          active-class="active-link"
          style="text-decoration: none; color: inherit"
          to="/inicio/cursos"
        >
          <div
            id="usuarios"
            tabindex="3"
            v-if="UsuarioLoggeado.tipo_usuario === 1"
          >
            <img src="./../../assets/svg/course.svg" alt="users" />
            <div id="txt">Cursos</div>
          </div></router-link
        >

        <div><br /><br /></div>

        <router-link
          active-class="active-link"
          style="text-decoration: none; color: inherit"
          to="/inicio/profesores"
        >
          <div
            id="clientes"
            tabindex="4"
            v-if="UsuarioLoggeado.tipo_usuario === 1"
          >
            <img src="./../../assets/svg/teacher.svg" alt="users" />
            <div id="txt">Profesores</div>
          </div></router-link
        >

        <div><br /><br /></div>

        <router-link
          active-class="active-link"
          style="text-decoration: none; color: inherit"
          to="/inicio/alumnos"
        >
          <div
            id="usuarios"
            tabindex="5"
            v-if="UsuarioLoggeado.tipo_usuario === 1"
          >
            <img src="./../../assets/svg/students.svg" alt="users" />
            <div id="txt">Alumnos</div>
          </div></router-link
        >

        <div><br /><br /></div>

        <router-link
          active-class="active-link"
          style="text-decoration: none; color: inherit"
          to="/inicio/ciclos"
        >
          <div
            id="usuarios"
            tabindex="6"
            v-if="UsuarioLoggeado.tipo_usuario === 1"
          >
            <img src="./../../assets/svg/cycle.svg" alt="users" />
            <div id="txt">Ciclos</div>
          </div></router-link
        >

        <div><br /><br /></div>

        <router-link
          active-class="active-link"
          style="text-decoration: none; color: inherit"
          to="/inicio/oferta-academica"
        >
          <div
            id="usuarios"
            tabindex="7"
            v-if="UsuarioLoggeado.tipo_usuario === 1"
          >
            <img src="./../../assets/svg/academic.svg" alt="users" />
            <div id="txt">Oferta Académica</div>
          </div></router-link
        >

        <div><br /><br /></div>
      </div>
    </div>
    <div id="half2">
      <div @click="logout" id="salir" tabindex="6">
        <img src="./../../assets/svg/logout.svg" alt="salir" />
        <div id="txt">Cerrar Sesión</div>
      </div>
    </div>
  </div>
</template>

<script>
import UserController from "../../controllers/userController.js";
import { mapMutations, mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters({
      UsuarioLoggeado: "LoginModule/UsuarioLoggeado",
      LoggedState: "LoginModule/LoggedState",
      Token: "LoginModule/Token",
    }),
  },
  methods: {
    ...mapMutations({
      Logout: "LoginModule/logout",
    }),
    async logout() {
      await UserController.logout(this.Token)
        .then((status) => {
          if (status === 200) {
            this.Logout();
            this.$router.push("/");
          }
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap");

@font-face {
  font-family: League-Gothic;
  src: url("@/assets/fonts/league-gothic.ttf");
}

#navbar {
  background-color: #f4f3f8;
  border-right-color: #c4c4c4;
  display: flex;
}

#SSC {
  font-family: "Cabin", sans-serif;
  text-shadow: 0px 3px 10px black;
  color: #1089d4;
  font-size: 1.25vw;
  justify-content: center;
  text-align: center;
  margin-top: 0;
  width: 100%;
}

#logonav img {
  width: 70%;
  height: auto;
}

#logonav {
  display: flex;
  cursor: pointer;
}

#menu {
  display: flex;
}

#buscador {
  display: flex;
  width: 2vw;
}

#buscador-input {
  font-size: 1vw;
  font-family: "Inter", sans-serif;
  text-align: left;
  padding: 0.3vw 0.1px 0.3vw 2vw;
  width: 70%;
  margin-left: 6%;
  background: #ffffff url(@/assets/svg/search.svg) no-repeat 9px center;
  border: solid 2px #969696;
  border-radius: 10px;
}

#tablero {
  display: flex;
}

#tablero:focus #txt {
  color: #1089d4;
}

#tablero:focus img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#tablero:hover #txt {
  color: #1089d4;
}

#tablero:hover img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#tablero div {
  font-family: "Inter", sans-serif;
  color: #737373;
  font-size: 1vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin-left: 2%;
  cursor: pointer;
}

#tablero img {
  margin-left: 6%;
  width: 20%;
  height: auto;
  cursor: pointer;
}

#tareas {
  display: flex;
}

#tareas:focus #txt {
  color: #1089d4;
}

#tareas:focus img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#tareas:hover #txt {
  color: #1089d4;
}

#tareas:hover img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#tareas div {
  font-family: "Inter", sans-serif;
  color: #737373;
  font-size: 1vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin-left: 2%;
  cursor: pointer;
}

#tareas img {
  margin-left: 4%;
  width: 20%;
  height: auto;
  cursor: pointer;
}

#usuarios {
  display: flex;
}

.active-link #usuarios #txt {
  color: #1089d4;
}

.active-link #usuarios img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

.active-link #subir #txt {
  color: #1089d4;
}

.active-link #subir img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#subir {
  display: flex;
}

#subir:hover #txt {
  color: #1089d4;
}

#subir:hover img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#subir div {
  font-family: "Inter", sans-serif;
  color: #737373;
  font-size: 1vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin-left: 2%;
  cursor: pointer;
  text-decoration: none;
}

#subir img {
  margin-left: 4%;
  width: 2vw;
  height: auto;
  cursor: pointer;
}

#usuarios:hover #txt {
  color: #1089d4;
}

.active-link #clientes #txt {
  color: #1089d4;
}

.active-link #clientes img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#usuarios:hover img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#usuarios div {
  font-family: "Inter", sans-serif;
  color: #737373;
  font-size: 1vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin-left: 2%;
  cursor: pointer;
  text-decoration: none;
}

#usuarios img {
  margin-left: 4%;
  width: 20%;
  height: auto;
  cursor: pointer;
}

#ajustes {
  display: flex;
  flex-direction: row;
  justify-content: left;
  margin-top: 7%;
}

#ajustes:focus #txt {
  color: #1089d4;
}

#ajustes:focus img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#ajustes:hover #txt {
  color: #1089d4;
}

#ajustes:hover img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#ajustes div {
  font-family: "Inter", sans-serif;
  color: #737373;
  font-size: 1vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin-left: 2%;
  cursor: pointer;
}

#ajustes img {
  margin-left: 4%;
  width: 13%;
  height: auto;
  cursor: pointer;
}

#ayuda {
  display: flex;
}

#ayuda:focus #txt {
  color: #1089d4;
}

#ayuda:focus img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#ayuda:hover #txt {
  color: #1089d4;
}

#ayuda:hover img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#ayuda div {
  font-family: "Inter", sans-serif;
  color: #737373;
  font-size: 1vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin-left: 2%;
  cursor: pointer;
}

#ayuda img {
  margin-left: 6%;
  width: 10%;
  height: auto;
  cursor: pointer;
}

#salir {
  display: flex;
}

#salir:hover #txt {
  color: #1089d4;
}

#salir:hover img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#salir div {
  font-family: "Inter", sans-serif;
  color: #737373;
  font-size: 1vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin-left: 2%;
  cursor: pointer;
}

#salir img {
  margin-left: 5%;
  width: 11%;
  height: auto;
  cursor: pointer;
}

#usuarios #txt {
  text-decoration: none;
  color: #737373;
}
#clientes {
  display: flex;
}

#clientes:hover #txt {
  color: #1089d4;
}

#clientes:hover img {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

#clientes div {
  font-family: "Inter", sans-serif;
  color: #737373;
  font-size: 1vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin-left: 2%;
  cursor: pointer;
  text-decoration: none;
}

#clientes img {
  margin-left: 4%;
  width: 2vw;
  height: auto;
  cursor: pointer;
}
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
  #navbar {
    width: 100%; /* Se cambio de 15% a 100% porque salia pequeño */
    height: 8vh;
    display: flex;
    flex-direction: row;
    border-right-width: 0px;
    align-items: center;
  }
  #SSC {
    width: 0%;
  }

  .active-link {
    height: 100%;
    border-left-width: 0px;
    border-top-color: #1089d4;
    border-top-style: solid;
    border-top-width: 2px;
  }
  #logonav {
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin: 0%;
    height: auto;
    width: 70%;
    cursor: pointer;
  }

  #menu {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
  }
  #buscador {
    display: none;
  }
  #half1 {
    display: flex;
    flex-direction: row;
    height: 100%;
  }
  #tablero {
    height: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
  }
  #tareas {
    height: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
  }
  #usuarios {
    height: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
  }
  #clientes {
    height: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
  }
  #tablero div {
    font-size: 0;
    margin-left: 0%;
  }
  #tareas div {
    font-size: 0;
    margin-left: 0%;
  }
  #usuarios div {
    font-size: 0;
    margin-left: 0%;
  }
  #clientes div {
    font-size: 0;
    margin-left: 0%;
  }
  #tablero img {
    height: 100%;
    width: 60%;
    cursor: pointer;
  }
  #clientes img {
    height: 100%;
    width: 100%;
    cursor: pointer;
  }
  #tareas img {
    height: 100%;
    width: 35%;
    cursor: pointer;
  }
  #usuarios img {
    height: 100%;
    width: 35%;
    cursor: pointer;
  }

  #tablero:focus {
    border-left-width: 0px;
    border-top-color: #1089d4;
    border-top-style: solid;
    border-top-width: 2px;
  }
  #tareas:focus {
    border-left-width: 0px;
    border-top-color: #1089d4;
    border-top-style: solid;
    border-top-width: 2px;
  }
  #usuarios:focus {
    border-left-width: 0px;
    border-top-color: #1089d4;
    border-top-style: solid;
    border-top-width: 2px;
  }
  #half2 {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    border-top-width: 0px;
    border-left-color: #c4c4c4;
    border-left-style: solid;
    border-left-width: 2px;
    height: 100%;
  }
  #ajustes {
    display: flex;
    flex-direction: row;
    justify-content: center;
    height: 100%;
    margin-top: 0%;
  }

  #ajustes:focus {
    border-left-width: 0px;
    border-top: solid;
    border-top-width: 2px;
    border-top-color: #1089d4;
  }

  #ajustes div {
    font-size: 0;
    margin-left: 2%;
    cursor: pointer;
    height: 100%;
  }

  #ajustes img {
    height: 100%;
    width: 40%;
    cursor: pointer;
  }

  #ayuda {
    display: flex;
    flex-direction: row;
    justify-content: center;
    height: 100%;
  }
  #ayuda:focus {
    border-left-width: 0px;
    border-top: solid;
    border-top-width: 2px;
    border-top-color: #1089d4;
  }
  #ayuda div {
    font-size: 0;
    cursor: pointer;
  }

  #ayuda img {
    height: 100%;
    width: 35%;
    cursor: pointer;
  }
  #salir {
    padding-bottom: 0%;
    padding-top: 0%;
    border-bottom-width: 0px;
    border-top-width: 0px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    height: 100%;
    margin-top: 0%;
  }

  #salir div {
    font-size: 0;
    margin-left: 2%;
  }

  #salir img {
    margin-left: 5%;
    height: 100%;
    width: 40%;
  }
}
/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
  #navbar {
    width: 100%; /* Se cambio de 15% a 100% porque salia pequeño */
    height: 8vh;
    display: flex;
    flex-direction: row;
    border-right-width: 0px;
    align-items: center;
  }

  #SSC {
    width: 0%;
  }

  .active-link {
    height: 100%;
    border-left-width: 0px;
    border-top-color: #1089d4;
    border-top-style: solid;
    border-top-width: 2px;
  }

  #logonav {
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin: 0%;
    height: auto;
    width: 20%;
    cursor: pointer;
  }

  #menu {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    margin-right: 3%;
  }

  #buscador {
    display: none;
  }

  #half1 {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    height: 100%;
    width: 70%;
  }

  #tablero {
    height: 100%;
  }
  #tablero img {
    height: 100%;
    width: 25%;
  }
  #tablero #txt {
    height: 100%;
    font-size: 1rem;
  }

  #tareas {
    height: 100%;
  }
  #tareas img {
    height: 100%;
    width: 25%;
  }
  #tareas #txt {
    height: 100%;
    font-size: 1rem;
  }
  #usuarios {
    height: 100%;
  }
  #usuarios img {
    height: 100%;
    width: 25%;
  }
  #usuarios #txt {
    height: 100%;
    font-size: 1rem;
  }
  #tablero:focus {
    border-left-width: 0px;
    border-top-color: #1089d4;
    border-top-style: solid;
    border-top-width: 2px;
  }

  #tareas:focus {
    border-left-width: 0px;
    border-top-color: #1089d4;
    border-top-style: solid;
    border-top-width: 2px;
  }

  #usuarios:focus {
    border-left-width: 0px;
  }

  #half2 {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    align-items: center;
    border-top-width: 0px;
    border-left-color: #c4c4c4;
    border-left-style: solid;
    border-left-width: 2px;
    height: 100%;
    width: 30%;
  }

  #ajustes {
    display: flex;
    flex-direction: row;
    justify-content: center;
    height: 100%;
    margin-top: 0%;
  }

  #ajustes:focus {
    border-left-width: 0px;
    border-top: solid;
    border-top-width: 2px;
    border-top-color: #1089d4;
  }

  #ajustes div {
    font-size: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-left: 2%;
    cursor: pointer;
    height: 100%;
  }

  #ajustes img {
    height: 100%;
    width: 2rem;
    cursor: pointer;
  }

  #ayuda {
    display: flex;
    flex-direction: row;
    justify-content: center;
    height: 100%;
  }

  #ayuda:focus {
    border-left-width: 0px;
    border-top: solid;
    border-top-width: 2px;
    border-top-color: #1089d4;
  }

  #ayuda div {
    font-family: "Inter", sans-serif;
    font-size: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    cursor: pointer;
  }

  #ayuda img {
    height: 100%;
    width: 1.8rem;
    cursor: pointer;
  }

  #salir {
    padding-bottom: 0%;
    padding-top: 0%;
    border-bottom-width: 0px;
    border-top-width: 0px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    height: 100%;
    margin-top: 0%;
  }

  #salir div {
    font-size: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-left: 2%;
  }

  #salir img {
    margin-left: 5%;
    height: 100%;
    width: 2rem;
  }
  #clientes {
    padding-bottom: 0%;
    padding-top: 0%;
    border-bottom-width: 0px;
    border-top-width: 0px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    height: 100%;
    margin-top: 0%;
  }

  #clientes div {
    font-size: 1rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-left: 2%;
    margin-right: 2%;
  }

  #clientes img {
    margin-left: 5%;
    height: 100%;
    width: 2rem;
    height: 100%;
    width: 25%;
  }
}
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
}
/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
}
/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
  #navbar {
    width: 15%; /* Se cambio de 15% a 100% porque salia pequeño */
    border-right-style: solid;
    border-right-width: 2px;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
  }

  #SSC {
    height: 2rem;
  }

  #logonav img {
    width: 65%;
    margin: 0;
    height: auto;
  }

  #logonav {
    flex-direction: row;
    justify-content: center;
    margin-top: 5%;
    width: 100%;
  }

  #tablero:focus {
    border-left-color: #1089d4;
    border-left-style: solid;
    border-left-width: 6px;
    border-top-width: 0px;
  }

  #tareas:focus {
    border-left-color: #1089d4;
    border-left-style: solid;
    border-left-width: 6px;
    border-top-width: 0px;
  }

  #usuarios:focus {
    border-top-width: 0px;
  }

  .active-link {
    border-left-color: #1089d4;
    border-left-style: solid;
    border-left-width: 6px;
    border-top-width: 0px;
  }

  #menu {
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
  }

  #buscador {
    flex-direction: column;
    justify-content: center;
    width: 100%;
  }

  #half1 {
    display: flex;
    flex-direction: column;
    justify-content: start;
    width: 100%;
  }

  #half2 {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: flex-start;
    border-top-color: #c4c4c4;
    border-top-style: solid;
    border-top-width: 2px;
    width: 100%;
    height: fit-content;
  }

  #ajustes {
    display: flex;
    flex-direction: row;
    justify-content: left;
    margin-top: 7%;
  }

  #ajustes:focus {
    border-left-color: #1089d4;
    border-left-style: solid;
    border-left-width: 6px;
    border-top-width: 0px;
  }

  #ajustes div {
    font-family: "Inter", sans-serif;
    color: #737373;
    font-size: 1vw;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-left: 2%;
    cursor: pointer;
  }

  #ajustes img {
    margin-left: 4%;
    width: 13%;
    height: auto;
    cursor: pointer;
  }

  #ayuda {
    display: flex;
    flex-direction: row;
    justify-content: left;
    width: 80%;
    height: auto;
  }

  #ayuda:focus {
    border-left-color: #1089d4;
    border-left-style: solid;
    border-left-width: 6px;
    border-top-width: 0px;
  }

  #ayuda:focus img {
    filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
      brightness(93%) contrast(90%);
  }

  #ayuda div {
    font-family: "Inter", sans-serif;
    color: #737373;
    font-size: 1vw;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-left: 2%;
    cursor: pointer;
  }

  #ayuda img {
    margin-left: 6%;
    width: 11%;
    height: auto;
    cursor: pointer;
  }

  #salir {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: left;
    padding-bottom: 4%;
    padding-top: 4%;
    border-bottom-color: #c4c4c4;
    border-bottom-style: solid;
    border-bottom-width: 2px;
    border-top-color: #c4c4c4;
    border-top-style: solid;
    border-top-width: 2px;
  }

  #salir div {
    font-family: "Inter", sans-serif;
    color: #737373;
    font-size: 1vw;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-left: 2%;
    cursor: pointer;
  }

  #salir img {
    margin-left: 5%;
    width: 11%;
    height: auto;
    cursor: pointer;
  }
}
</style>