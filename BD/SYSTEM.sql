ALTER SESSION SET "_ORACLE_SCRIPT" = TRUE;

CREATE TABLESPACE GestionAcademica_Data DATAFILE 'C:\app\danil\product\18.0.0\oradata\XE\GestionAcademica_Data.DBD' SIZE 100M AUTOEXTEND on next 100M;

CREATE TEMPORARY TABLESPACE GestionAcademica_Temp TEMPFILE 'C:\app\danil\product\18.0.0\oradata\XE\GestionAcademica_Temp.DBF' SIZE 25M AUTOEXTEND ON;

CREATE USER GestionAcademica IDENTIFIED BY root123 DEFAULT TABLESPACE GestionAcademica_Data 
TEMPORARY TABLESPACE GestionAcademica_Temp;

GRANT RESOURCE TO GestionAcademica;
GRANT CONNECT TO GestionAcademica;
GRANT ALL PRIVILEGES TO GestionAcademica;

