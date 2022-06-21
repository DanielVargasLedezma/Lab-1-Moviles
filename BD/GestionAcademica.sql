CREATE OR REPLACE PACKAGE types
AS
     TYPE ref_cursor IS REF CURSOR;
END;

------------------------------------------------------------ Carrera --------------------------------------------------------------------------
CREATE TABLE CARRERAS(
    codigo_carrera VARCHAR2(255) not null,
    nombre VARCHAR2(255),
    titulo VARCHAR2(255),
    CONSTRAINT PK_Carrera PRIMARY KEY(codigo_carrera)
);

------------------------------------------------------------ Curso --------------------------------------------------------------------------

CREATE TABLE CURSOS(
    codigo_curso VARCHAR2(255) not null,
    codigo_carrera VARCHAR2(255) not null,
    nombre VARCHAR2(255),
    creditos number(5),
    horas_semanales NUMBER(5),
    num_semestre_a_llevar NUMBER(5),
    anyo_a_llevar VARCHAR2(255),
    CONSTRAINT PK_Curso PRIMARY KEY(codigo_curso)
);

------------------------------------------------------------ CICLO --------------------------------------------------------------------------

CREATE TABLE CICLOS(
    ID_CICLO number(19) not null,
    NUMERO_CICLO NUMBER(5),
    YEAR NUMBER(5),
    FECHA_INICIO DATE,
    fecha_finalizacion DATE,
    ciclo_activo NUMBER(5),
    CONSTRAINTS PK_CICLO PRIMARY KEY(ID_CICLO)
);

------------------------------------------------------------ Profesor --------------------------------------------------------------------------

CREATE TABLE PROFESORES(
    cedula_profesor VARCHAR2(255) NOT NULL,
    nombre VARCHAR2(255),
    telefono number(19),
    correoE VARCHAR2(255),
    clave VARCHAR2(255) NOT NULL,
    CONSTRAINTS PK_PROFESOR PRIMARY KEY(cedula_profesor)
);

------------------------------------------------------------ ALUMNO --------------------------------------------------------------------------

CREATE TABLE ALUMNOS(
    CEDULA_ALUMNO VARCHAR2(255) not null,
    NOMBRE VARCHAR2(255),
    TELEFONO NUMBER(19),
    CORREOE VARCHAR2(255),
    FECHA_NACIMIENTO DATE,
    CODIGO_CARRERA VARCHAR2(255) not null,
    clave VARCHAR2(255) NOT NULL,
    CONSTRAINTS PK_ALUMNO PRIMARY KEY(CEDULA_ALUMNO)
);

------------------------------------------------------------ GRUPOs --------------------------------------------------------------------------

CREATE TABLE GRUPOS(
    NUMERO_GRUPO VARCHAR2(255) not null,
    CODIGO_CURSO VARCHAR2(255) not null,
    CEDULA_PROFESOR VARCHAR2(255) not null,
    ID_CICLO number(19) NOT NULL,
    HORARIO VARCHAR2(255),
    dia_uno VARCHAR2(255),
    dia_dos VARCHAR2(255),
    CONSTRAINTS PK_GRUPO PRIMARY KEY(NUMERO_GRUPO)
);

------------------------------------------------------------ GRUPOs -------------------------------------------------------------------------

CREATE TABLE MATRICULAS(
    Numero_MATRICULA number(19) not null,
    CEDULA_ALUMNO VARCHAR2(255) not null,
    NUMERO_GRUPO VARCHAR2(255) not null,
    NOTA number(5),
    CONSTRAINTS PK_MATRICULAS PRIMARY KEY(Numero_MATRICULA)
);

------------------------------------------------------------ USUARIOS -------------------------------------------------------------------------

CREATE TABLE USUARIOS(
    CEDULA_usuario VARCHAR2(255),
    CLAVE VARCHAR2(255),
    nombre VARCHAR2(255),
    correo VARCHAR2(255),
    tipo_usuario number(5),
    estado number(5),
    CONSTRAINTS PK_USUARIOS PRIMARY KEY(CEDULA_usuario)
);

------------------------------------------------------------ Foraneas Cursos --------------------------------------------------------------------------

ALTER TABLE GestionAcademica.Cursos ADD CONSTRAINT FK_Carrera_Cur FOREIGN KEY (codigo_carrera) 
REFERENCES GestionAcademica.Carreras (codigo_carrera) on delete cascade;


------------------------------------------------------------ Foraneas Alumno --------------------------------------------------------------------------

ALTER TABLE GestionAcademica.ALUMNOs ADD CONSTRAINT FK_Carrera_ALUMNO FOREIGN KEY (codigo_carrera) 
REFERENCES GestionAcademica.Carreras (codigo_carrera) on delete cascade;


------------------------------------------------------------ Foraneas Grupo --------------------------------------------------------------------------

ALTER TABLE GestionAcademica.grupo ADD CONSTRAINT FK_Cur_grupo FOREIGN KEY (codigo_curso) 
REFERENCES GestionAcademica.Cursos (codigo_curso) on delete cascade;

ALTER TABLE GestionAcademica.grupo ADD CONSTRAINT FK_Ciclo_grupo FOREIGN KEY (ID_ciclo) 
REFERENCES GestionAcademica.CICLOs (ID_ciclo) on delete cascade;

ALTER TABLE GestionAcademica.grupo ADD CONSTRAINT FK_Prof_grupo FOREIGN KEY (cedula_profesor) 
REFERENCES GestionAcademica.Profesores (cedula_profesor) on delete cascade;


------------------------------------------------------------ Foraneas Matriculas --------------------------------------------------------------------------

ALTER TABLE GestionAcademica.matriculas ADD CONSTRAINT FK_ALUMNO_matricula FOREIGN KEY (cedula_alumno) 
REFERENCES GestionAcademica.ALUMNOs (cedula_alumno) on delete cascade;

ALTER TABLE GestionAcademica.matriculas ADD CONSTRAINT FK_grupo_matricula FOREIGN KEY (numero_grupo) 
REFERENCES GestionAcademica.grupo (numero_grupo) on delete cascade;

------------------------------------------------------------ Procedimientos de Carrera --------------------------------------------------------------------------

------------------------------------------------------------ Insertar

CREATE OR REPLACE PROCEDURE insertarCarrera(
    codigo_carrera IN Carreras.codigo_carrera%TYPE, 
    nombre IN Carreras.nombre%TYPE, 
    titulo IN Carreras.titulo%TYPE
)
AS
BEGIN
	INSERT INTO GestionAcademica.Carreras (codigo_carrera, nombre, titulo) VALUES(codigo_carrera, nombre, titulo);
END;



------------------------------------------------------------ Buscar (uno) 

CREATE OR REPLACE FUNCTION buscarCarrera(codigo_carrera IN Carreras.codigo_carrera%TYPE)
RETURN Types.ref_cursor 
AS 
        carrera_cursor types.ref_cursor; 
BEGIN 
    OPEN carrera_cursor FOR 
       SELECT car.codigo_carrera, car.nombre, car.titulo FROM GestionAcademica.Carreras car
       WHERE codigo_carrera=codigo_carrera; 
    
    RETURN carrera_cursor; 
END;



------------------------------------------------------------ Buscar cursos de carrera (una)

create or replace FUNCTION buscarCursosDeCarrera(codigo_carrera_in IN Carreras.codigo_carrera%TYPE)
RETURN Types.ref_cursor 
AS 
        carrera_cursor types.ref_cursor; 
BEGIN 
    OPEN carrera_cursor FOR 
       SELECT 
            curr.codigo_curso, curr.nombre, curr.creditos, curr.horas_semanales,
            curr.num_semestre_a_llevar, curr.anyo_a_llevar
       FROM GestionAcademica.Carreras car
       JOIN GestionAcademica.Cursos curr ON (car.codigo_carrera = curr.codigo_carrera)
       WHERE (car.codigo_carrera = codigo_carrera_in); 

    RETURN carrera_cursor; 
END;



------------------------------------------------------------ Buscar (Todas)

CREATE OR REPLACE FUNCTION listarCarreras
RETURN Types.ref_cursor 
AS 
        carrera_cursor types.ref_cursor; 
BEGIN 
    OPEN carrera_cursor FOR 
       SELECT car.codigo_carrera, car.nombre, car.titulo FROM GestionAcademica.Carreras car; 
    RETURN carrera_cursor; 
END;



------------------------------------------------------------ Eliminar

create or replace procedure eliminarCarrera(codigo_carrera IN Carreras.codigo_carrera%TYPE)
as
begin
    delete from GestionAcademica.Carreras where codigo_carrera=codigo_carrera;
end;



------------------------------------------------------------ Modificar

CREATE OR REPLACE PROCEDURE modificarCarrera (
    codigo_carrera_in IN Carreras.codigo_carrera%TYPE, 
    nombre_in IN Carreras.nombre%TYPE, 
    titulo_in IN Carreras.titulo%TYPE
)
AS
BEGIN
    UPDATE GestionAcademica.Carreras SET nombre=nombre_in,titulo=titulo_in WHERE codigo_carrera=codigo_carrera_in;
END;



------------------------------------------------------------ Procedimientos de Profesor
------------------------------------------------------------ Insertar

CREATE OR REPLACE PROCEDURE insertarProfesor(
    CEDULA_PROFESOR IN Profesores.CEDULA_PROFESOR%TYPE, 
    nombre IN Profesores.nombre%TYPE, 
    telefono IN Profesores.telefono%TYPE,
    correoE IN Profesores.correoE%TYPE
)
AS
BEGIN
	INSERT INTO GestionAcademica.Profesores (CEDULA_PROFESOR, nombre, telefono, correoE) VALUES(CEDULA_PROFESOR, nombre, telefono, correoE);
END;



------------------------------------------------------------ Buscar (uno)

CREATE OR REPLACE FUNCTION buscarProfesor(CEDULA_PROFESOR IN Profesores.CEDULA_PROFESOR%TYPE)
RETURN Types.ref_cursor 
AS 
        profesor_cursor types.ref_cursor; 
BEGIN 
    OPEN profesor_cursor FOR 
       SELECT pro.CEDULA_PROFESOR, pro.nombre, pro.telefono, pro.correoE FROM GestionAcademica.Profesores pro
       WHERE CEDULA_PROFESOR=CEDULA_PROFESOR; 
    
    RETURN profesor_cursor; 
END;



------------------------------------------------------------ Buscar (Todos)

CREATE OR REPLACE FUNCTION listarProfesores
RETURN Types.ref_cursor 
AS 
        profesor_cursor types.ref_cursor; 
BEGIN 
    OPEN profesor_cursor FOR 
       SELECT pro.CEDULA_PROFESOR, pro.nombre, pro.telefono, pro.correoE FROM GestionAcademica.Profesores pro; 
    RETURN profesor_cursor; 
END;



------------------------------------------------------------ Eliminar

create or replace procedure eliminarProfesor(CEDULA_PROFESOR IN Profesores.CEDULA_PROFESOR%TYPE)
as
begin
    delete from GestionAcademica.Profesores where CEDULA_PROFESOR=CEDULA_PROFESOR;
end;



------------------------------------------------------------ Modificar

CREATE OR REPLACE PROCEDURE modificarProfesor (
    CEDULA_PROFESOR IN Profesores.CEDULA_PROFESOR%TYPE, 
    nombre IN Profesores.nombre%TYPE, 
    telefono IN Profesores.telefono%TYPE,
    correoE IN Profesores.correoE%TYPE
)
AS
BEGIN
    UPDATE GestionAcademica.Profesores SET nombre=nombre,telefono=telefono, correoE=correoE WHERE CEDULA_PROFESOR=CEDULA_PROFESOR;
END;













