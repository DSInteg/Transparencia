<?php
/*
 * Pruebas.php 1.0  06/09/2017
 * Copyright (c) 2017 DSIntec, Inc.
 */

require_once('../core/modelo_area.php');
require_once('../core/modelo_empleado.php');


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
$idEmpleado=1;
$arrayEmpleado = array(
			'idUsuario' => '', 
			'idEmpleado' => '',
			'idArea' => '',
			'nombre' => '',
			'paterno' => '',
			'materno' => '',
			'email' => '');
$arrayArea = array(
			'idArea' => '',
			'nombreArea'=>''
		);
$Empleado=new Empleado($idEmpleado);
$arrayEmpleado=$Empleado->getEmpleado();
$idArea=$Empleado -> getEmpleadoIdArea();
$Area = new Area($idArea);
$arrayArea=$Area->getArea();
echo json_encode($arrayEmpleado);
echo json_encode($arrayArea);
/*
foreach ($datos as $indice => $valor) {
      echo $indice;
      //var_dump($valor);
}
*/
//echo json_encode($datos);
?>