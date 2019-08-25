<?php
/*
 * login.php 1.0  06/09/2017
 * Copyright (c) 2017 DSIntec, Inc.
 */

require_once('../core/modelo_publicadocumento.php');

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
$idDocumento = $_POST['Documento'];
$idSubeDocumento = $_POST['SubeDocumento'];
$idApruebaDocumento = $_POST['ApruebaDocumento'];
$idUsuario = $_POST['Usuario'];
//Debemnos checar el manejador de errores para Querys
//La mejor opción seria que de la linea item, obubiera el sube documento y el aprueba documento
//Se actualizara cuando se sube y cuando se aprueba, para confiar en esos

$documento= new PublicaDocumento;
$last_id=$documento->publicaDocumentoTransparencia($idDocumento,$idSubeDocumento,$idApruebaDocumento,$idUsuario);

$respuesta= array("exito" => true,
 					"last_id"=>$last_id,
 					"idDocumento"=>$idDocumento);
echo json_encode($respuesta);
?>