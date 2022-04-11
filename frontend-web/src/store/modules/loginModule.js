const LoginModule = {
  namespaced: true,
  state: {
    userLogged: null,
    logged: false,
    token: "",
  },
  mutations: {
    setUserLogged(state, payload) {
      state.userLogged = payload;
    },
    setToken(state, payload) {
      state.token = payload;
    },
    setLoggedState(state, payload) {
      state.logged = payload;
    },
    logout(state) {
      state.userLogged = null;
      state.token = "";
      state.logged = false;
    },
  },
  getters: {
    UsuarioLoggeado: (state) => {
      return state.userLogged;
    },
    LoggedState: (state) => {
      return state.logged;
    },
    Token: (state) => {
      return state.token;
    },
  },
};

export default LoginModule;
