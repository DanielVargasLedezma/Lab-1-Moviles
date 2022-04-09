CREATE OR REPLACE PACKAGE types
AS
     TYPE ref_cursor IS REF CURSOR;
END;

------------------------------------------------------------ Carrera --------------------------------------------------------------------------
CREATE TABLE Carreras(
    codigo_carrera number(12) not null,
    nombre VARCHAR2(50),
    titulo VARCHAR2(250),
    CONSTRAINT PK_Carrera PRIMARY KEY(codigo_carrera)
);

------------------------------------------------------------ Curso --------------------------------------------------------------------------

CREATE TABLE Cursos(
    codigo_curso number(12) not null,
    nombre VARCHAR2(50),
    creditos number(2),
    horas_semanales NUMBER(2),
    CONSTRAINT PK_Curso PRIMARY KEY(codigo_curso)
);

------------------------------------------------------------ Cursos de Carrera --------------------------------------------------------------------------

CREATE TABLE CursosDeCarrera(
    codigo_carrera number(12) not null,
    codigo_curso number(12) not null,
    año number(4),
    ciclo number(12) not null
);


------------------------------------------------------------ Profesor --------------------------------------------------------------------------

CREATE TABLE Profesores(
    cedula_profesor VARCHAR2(50),
    nombre VARCHAR2(50),
    telefono number(12),
    correoE VARCHAR2(50),
CONSTRAINTS PK_PROFESOR PRIMARY KEY(cedula_profesor)
);

------------------------------------------------------------ Foráneas Cursos de Carrera --------------------------------------------------------------------------

ALTER TABLE GestionAcademica.CursosDeCarrera ADD CONSTRAINT FK_Carrera_CurCarr FOREIGN KEY (codigo_carrera) REFERENCES GestionAcademica.Carreras (codigo_carrera) on delete cascade;

ALTER TABLE GestionAcademica.CursosDeCarrera ADD CONSTRAINT FK_Cur_CurCarr FOREIGN KEY (codigo_curso) REFERENCES GestionAcademica.Cursos (codigo_curso) on delete cascade;



------------------------------------------------------------ Procedimientos de Carrera --------------------------------------------------------------------------



------------------------------------------------------------ Insertar --------------------------------------------------------------------------

CREATE OR REPLACE PROCEDURE insertarCarrera(
    codigo_carrera IN Carreras.codigo_carrera%TYPE, 
    nombre IN Carreras.nombre%TYPE, 
    titulo IN Carreras.titulo%TYPE
)
AS
BEGIN
	INSERT INTO GestionAcademica.Carreras (codigo_carrera, nombre, titulo) VALUES(codigo_carrera, nombre, titulo);
END;



------------------------------------------------------------ Buscar (uno) --------------------------------------------------------------------------

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



------------------------------------------------------------ Buscar cursos de carrera (una) --------------------------------------------------------------------------

CREATE OR REPLACE FUNCTION buscarCursosDeCarrera(codigo_carrera IN Carreras.codigo_carrera%TYPE)
RETURN Types.ref_cursor 
AS 
        carrera_cursor types.ref_cursor; 
BEGIN 
    OPEN carrera_cursor FOR 
       SELECT 
            car.codigo_carrera, car.nombre, car.titulo, curr.codigo_curso, curr.nombre, curr.creditos, curr.horas_semanales,  
            carcurr."AÑO", carcurr.ciclo
       FROM GestionAcademica.Carreras car
       JOIN GestionAcademica.CursosDeCarrera carcurr ON (car.codigo_carrera = carcurr.codigo_carrera)
       JOIN GestionAcademica.Cursos curr ON (carcurr.codigo_curso = curr.codigo_curso)
       WHERE (car.codigo_carrera = codigo_carrera); 
    
    RETURN carrera_cursor; 
END;



------------------------------------------------------------ Buscar (Todas) --------------------------------------------------------------------------

CREATE OR REPLACE FUNCTION listarCarreras
RETURN Types.ref_cursor 
AS 
        carrera_cursor types.ref_cursor; 
BEGIN 
    OPEN carrera_cursor FOR 
       SELECT car.codigo_carrera, car.nombre, car.titulo FROM GestionAcademica.Carreras car; 
    RETURN carrera_cursor; 
END;



------------------------------------------------------------ Eliminar --------------------------------------------------------------------------

create or replace procedure eliminarCarrera(codigo_carrera IN Carreras.codigo_carrera%TYPE)
as
begin
    delete from GestionAcademica.Carreras where codigo_carrera=codigo_carrera;
end;



------------------------------------------------------------ Modificar --------------------------------------------------------------------------

CREATE OR REPLACE PROCEDURE modificarCarrera (
    codigo_carrera_in IN Carreras.codigo_carrera%TYPE, 
    nombre_in IN Carreras.nombre%TYPE, 
    titulo_in IN Carreras.titulo%TYPE
)
AS
BEGIN
    UPDATE GestionAcademica.Carreras SET nombre=nombre_in,titulo=titulo_in WHERE codigo_carrera=codigo_carrera_in;
END;



------------------------------------------------------------ Procedimientos de Profesor --------------------------------------------------------------------------



------------------------------------------------------------ Insertar --------------------------------------------------------------------------

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



------------------------------------------------------------ Buscar (uno) --------------------------------------------------------------------------

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



------------------------------------------------------------ Buscar (Todos) --------------------------------------------------------------------------

CREATE OR REPLACE FUNCTION listarProfesores
RETURN Types.ref_cursor 
AS 
        profesor_cursor types.ref_cursor; 
BEGIN 
    OPEN profesor_cursor FOR 
       SELECT pro.CEDULA_PROFESOR, pro.nombre, pro.telefono, pro.correoE FROM GestionAcademica.Profesores pro; 
    RETURN profesor_cursor; 
END;



------------------------------------------------------------ Eliminar --------------------------------------------------------------------------

create or replace procedure eliminarProfesor(CEDULA_PROFESOR IN Profesores.CEDULA_PROFESOR%TYPE)
as
begin
    delete from GestionAcademica.Profesores where CEDULA_PROFESOR=CEDULA_PROFESOR;
end;



------------------------------------------------------------ Modificar --------------------------------------------------------------------------

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













