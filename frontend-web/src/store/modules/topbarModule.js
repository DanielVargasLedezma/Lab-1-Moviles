const topbarModule = {
  namespaced: true,
  state: {
    hidenav: true,
    viewingGestorClients: false,
  },
  mutations: {
    SET_HIDENAV(state, response) {
      state.hidenav = response;
    },
    set_viewingGestorClients(state, response) {
      state.viewingGestorClients = response;
    },
  },
  actions: {},
  getters: {
    GetHidenav: (state) => {
      return state.hidenav;
    },
    get_viewingGestorClients: (state) => {
      return state.viewingGestorClients;
    },
  },
};

export default topbarModule;
