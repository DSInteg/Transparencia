<?php
/*
 * login.php 1.0  06/09/2017
 * Copyright (c) 2017 DSIntec, Inc.
 */

require_once('../core/modelo_login.php');
require_once('../core/modelo_sesion.php');

/**
 * Servicio login recibe el usuario (string) y password (string)
 * Y si existe el usuario lo dirige al inicio de seción
 * si hay problemas en la sesión la reporta o carga la sesión con las condicionantes
 * requiere carga el modelo del login del usuario modelo_login.php
 * 
 * @version 1.0 06/09/2017
 * @author Juan Jose Cordova Zamorano  		
 * 
 */
$cveusuario = $_POST['usuario'];
$password = $_POST['password'];
//$cveusuario = 'jcordova';
//$password = '123';
//crea objeto usuario
$login= new UsuarioLogin;
$acceso = $login->setLogin($cveusuario, $password);
$respuesta='';
$respuesta["exito"]=0;
//si no existe el usuario regresa a index.php
if ($acceso==false):
	//echo "USUARIO O CONTRASENA INVALIDA, INTENTA DE NUEVO";	
	$respuesta["mensaje"]="1";
//si existe el usuario obtenemos los datos del empleado
else:
	$sesion=new ControlSesion($login->getIdEmpleado());
	$html=$sesion->creaSesion($login->getIdEmpleado());				
	$datos=$sesion->getDatos();
	$respuesta["exito"]=1;
	$respuesta["mensaje"]=$html;
	$respuesta["Empleado"]=$datos["Empleado"];
	$respuesta["Area"]=$datos["Area"];
endif;
echo json_encode($respuesta);
?>