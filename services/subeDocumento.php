<?php
/*
 * login.php 1.0  06/09/2017
 * Copyright (c) 2017 DSIntec, Inc.
 */

require_once('../core/modelo_subedocumento.php');
require_once('../core/modelo_date.php');

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
$idDocumento = $_POST['idDocumento'];
$idUsuario = $_POST['idUsuario'];
$URL =$_POST['url'];
//Debemnos checar el manejador de errores para Querys

$documento= new SubeDocumento;
$last_id=$documento->subeDocumentoTransparencia($idDocumento,$idUsuario,$URL);
$fecha=new DateMYSQL;
$date=$fecha->getDate();
$respuesta= array("exito" => true,
 					"last_id"=>$last_id,
 					"fecha"=>$date['CURRENT_TIMESTAMP']);
echo json_encode($respuesta);
?>