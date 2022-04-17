import User from "../../models/usuario.js";

const TableAlumnoModule = {
    namespaced: true,
    state: {
        //Cantidad total de usuarios o clientes
        cantidadTotalUoC: 0,

        //Pagina en la que se ubica según el índice
        numeroPaginaActual: 1,

        //Visibilidad de las columnas de la tabla
        columnas: [true, true, true, true, true, true, true],

        servicioSeleccionado: "",

        tableName: "",

        array: [],
        clumnsTitle: [],

        texto: "",

        opcionComboBox: "",

        opcionComboBoxReverse: false,

        usuarioActual: new User(),

        carreraActual: null,

        alumnoActual: null,

        mostrarTabla: true,

        servgestor: [],

        nombreServ: [],
    },
    mutations: {
        SET_NOMBRE_SERVICIOS(state, name) {
            state.nombreServ = name;
        },
        SET_SERVICIOS_GESTOR(state, arr) {
            state.servgestor = arr;
        },
        SET_MOSTRAR_TABLA(state, mostrar) {
            state.mostrarTabla = mostrar;
        },
        SET_CANTIDAD_UoC(state, cantidad) {
            state.cantidadTotalUoC = cantidad;
        },
        SET_PAGINA_ACTUAL(state, numPagina) {
            state.numeroPaginaActual = numPagina;
        },
        SET_VISIBILIDAD_COLUMNAS(state, index) {
            state.columnas[index] = !state.columnas[index];
        },
        SET_SERVICIO_SELECCIONADO(state, servicio) {
            state.servicioSeleccionado = servicio;
        },
        SET_TABLE_NAME(state, response) {
            state.tableName = response;
        },
        SET_ARRAY(state, response) {
            state.array = response;
        },
        SET_COLUMNS_TITLE(state, response) {
            state.clumnsTitle = response;
        },
        SET_OPC_COMBO_BOX(state, response) {
            state.opcionComboBox = response;
        },
        SET_OPC_COMBO_BOX_REVERSE(state, response) {
            state.opcionComboBoxReverse = response;
        },
        SET_TEXTO(state, response) {
            state.texto = response;
        },
        SET_USUARIO_ACTUAL(state, usuario) {
            state.usuarioActual = usuario;
        },
        SET_ALUMNO_ACTUAL(state, payload) {
            state.alumnoActual = payload;
        },
    },
    getters: {
        GET_NOMBRE_SERVICIOS(state) {
            return state.nombreServ;
        },
        GET_SERVICIOS_GESTOR(state) {
            return state.servgestor;
        },
        GET_MOSTRAR_TABLA(state) {
            return state.mostrarTabla;
        },
        GET_CANTIDAD_UoC(state) {
            return state.cantidadTotalUoC;
        },
        GET_PAGINA_ACTUAL(state) {
            return state.numeroPaginaActual;
        },
        GET_VISIBILIDAD_COLUMNAS(state) {
            return state.columnas;
        },
        GET_SERVICIO_SELECCIONADO(state) {
            return state.servicioSeleccionado;
        },

        GET_TABLE_NAME(state) {
            return state.tableName;
        },
        GET_ARRAY(state) {
            return state.array;
        },
        GET_COLUMNS_TITLE(state) {
            return state.clumnsTitle;
        },

        GetOpcionComboBox: (state) => {
            return state.opcionComboBox;
        },
        GetTexto: (state) => {
            return state.texto;
        },
        GetOpcionComboBoxReverse: (state) => {
            return state.opcionComboBoxReverse;
        },
        GetUsuarioActual: (state) => {
            return state.usuarioActual;
        },
        GET_ALUMNO_ACTUAL: (state) => {
            return state.alumnoActual;
        },
    },
};

export default TableAlumnoModule;
