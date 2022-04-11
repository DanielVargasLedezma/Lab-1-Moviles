<template>
  <div>
    <div class="navbar">
      <a title="Ir atrás" @click="$router.go(-1)">
        <img
          src="./../../assets/svg/back.svg"
          alt="hide/show"
          class="icon icon--2x"
        />
      </a>

      <div @click="isShow = false" class="topnav-centered">
        <a class="top-nav-text">
          <div id="SSC">
            <span style="color: black">Sistema de </span>Matrícula Estudiantil
          </div>
          <div id="SSCmini"><span style="color: black">S</span>SC</div>
        </a>
      </div>

      <div class="topnav-right">
        <a>
          <img
            src="./../../assets/svg/alert.svg"
            alt="alerts"
            class="icon icon--3x"
          />
        </a>

        <a @click="isShow = true"
          ><img
            src="./../../assets/svg/user.svg"
            alt="profile"
            class="icon icon--2x"
          />
        </a>
        <transition>
          <div v-if="isShow" id="myModal" class="modal">
            <!-- Modal content -->

            <div class="content-modal">
              <span @click="isShow = !isShow" class="close">&times;</span><br />

              <p
                style="
                  color: #071e55;
                  margin-top: -15px;
                  margin-bottom: 10px;
                  text-align: center;
                "
              >
                <img
                  src="./../../assets/svg/user.svg"
                  alt="profile"
                  class="icon icon--2x"
                /><br />
                <span v-if="UsuarioLoggeado.nombre">
                  {{ UsuarioLoggeado.nombre }} <br
                /></span>

                {{ UsuarioLoggeado.cedula }}
              </p>
              <br />
              <section>
                <div @click="logout">
                  <a
                    id="myBtn"
                    active-class="active-link"
                    style="
                      text-decoration: none;
                      color: inherit;
                      margin: 0;
                      padding: 0;
                      font-family: 'cabin', sans-serif;
                    "
                  >
                    <img
                      src="./../../assets/svg/logout.svg"
                      alt="profile"
                      class="icon icon--2x"
                    />Cerrar Sesión
                  </a>
                </div>
              </section>
              <br />
              <br />
            </div>
          </div>
        </transition>
      </div>
    </div>
  </div>
</template>
<script>
import { mapMutations, mapGetters } from "vuex";
import UserController from "../../controllers/userController.js";

export default {
  data() {
    return {
      isShow: false,
    };
  },
  computed: {
    ...mapGetters({
      UsuarioLoggeado: ["LoginModule/UsuarioLoggeado"],
      LoggedState: ["LoginModule/LoggedState"],
      Token: "LoginModule/Token",
    }),
  },
  mounted() {},
  methods: {
    ...mapMutations({
      setUserLogged: "LoginModule/setUserLogged",
      setToken: "LoginModule/setToken",
      setLoggedState: "LoginModule/setLoggedState",
      LogOut: "LoginModule/logout",
    }),
    async logout() {
      await UserController.logout(this.Token)
        .then((status) => {
          if (status === 200) {
            this.LogOut();
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
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css");
.v-enter-active {
  transition: all 0.3s ease;
}
.v-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.v-enter-from,
.v-leave-to {
  transform: scaleY(0);
}

.modal {
  text-align: center;
  display: inline-block;
  font-family: "Cabin", sans-serif;
  margin-left: 80%;
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 60px; /* Location of the box */
  border-radius: 0px 0 10px 10px;
  transform-origin: top;
  left: 0;
  top: 0;
  width: 20vw; /* Full width */
  height: 12vw; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
}

.modal a:hover {
  filter: invert(41%) sepia(35%) saturate(2683%) hue-rotate(178deg)
    brightness(93%) contrast(90%);
}

/* Modal Content */
.content-modal {
  border-radius: 10px;
  text-align: left;
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  display: inline-block;
}

/* The Close Button */
.close {
  margin-right: -5%;
  margin-top: -8%;
  color: #aaaaaa;
  float: right;
  font-size: 30px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
:root {
  --sidebar-width: 20vw;
}
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  background-color: #ffffff;
  overflow: hidden;
  border-bottom-color: #c8c4c4;
  border-bottom-style: solid;
  border-bottom-width: 2px;
  display: block;
  width: 100% - var(--sidebar-width);
}

.topnav-centered a {
  left: 30%;
  font-family: "Cabin", sans-serif;
  text-shadow: 0px 3px 10px black;
  color: #1089d4;
  font-size: 1.35em;
}
#SSC {
  font-family: "Cabin", sans-serif;
  text-shadow: 0px 0px 0px black;
  color: #1089d4;
  justify-content: center;
  text-align: center;
  margin-top: 0;
  width: 100%;
}
#SSCmini {
  font-family: "Cabin", sans-serif;
  text-shadow: 0px 0px 0px black;
  color: #1089d4;
  justify-content: center;
  text-align: center;
  margin-top: 0;
  width: 100%;
  display: none;
}
.icon {
  block-size: 25px;
  display: inline-block;
  fill: currentcolor;
  inline-size: 1em;
  vertical-align: middle;
  margin: 0;
}

.icon--2x {
  font-size: 2rem;
  max-inline-size: 100%;
}

.icon--3x {
  font-size: 2.3rem;
  max-inline-size: 100%;
}

a {
  color: inherit;
  outline: 0;
  margin: 0;
}
.navbar a {
  transition: ease-in-out 0.2s;
  padding: 0;
  float: left;
  padding: 13px;
  color: #787474;
  text-decoration: none;
  display: block;
  position: relative;
  margin: 0;
}
.navbar a:hover {
  transition: ease-in-out 0.2s;

  cursor: pointer;
}

.navbar .active {
  transform: rotate(180deg);
  transition: ease-in-out 0.2s;
  filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(252deg) brightness(0%)
    contrast(100%);
}

.topnav-right {
  float: right;
}

.sidenav {
  height: 100%;
  width: var(--sidebar-width);
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #f8f4fc;
  overflow-x: hidden;
  border-right-color: #c8c4c4;
  border-right-style: solid;
  border-right-width: 2.5px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}
@media screen and (max-width: 1000px) {
  .icon {
    block-size: 15px;
  }
  .topnav-centered a {
    left: 30vw;
    font-size: 1em;
  }
  .modal {
    width: 40%; /* Full width */
    height: 25%; /* Full height */
    margin-left: 60%;
  }
}
@media screen and (max-width: 800px) {
  .icon {
    block-size: 15px;
  }
  .topnav-centered a {
    font-size: 1.3em;
  }

  #SSC {
    display: none;
  }
  #SSCmini {
    display: block;
  }
}
@media screen and (max-width: 500px) {
  .icon {
    block-size: 15px;
  }
  .topnav-centered a {
    font-size: 1em;
  }
}
@media screen and (max-width: 300px) {
  .icon {
    block-size: 15px;
  }
  .topnav-centered a {
    font-size: 0.2em;
  }
}
</style>
