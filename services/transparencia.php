<?php
/*
 * login.php 1.0  06/09/2017
 * Copyright (c) 2017 DSIntec, Inc.
 */

//require_once('../core/modelo_transparencia.php'); //PLATILLA DE IRVIN
require_once('../core/modelo_new_transparencia.php'); //PLATILLA DE WORDPRES

/**
 * Servicio login recibe el usuario (string) y password (string)
 * Y si existe el usuario lo dirige al inicio de seción
 * si hay problemas en la sesión la reporta o carga la sesión con las condicionantes
 * requiere carga el modelo del login del usuario modelo_login.php
 * 
 * @version 2.0 20/12/2017
 * @author Juan Jose Cordova Zamorano  		
 * 
 */
$transparencia = $_POST['transparencia'];
$sesion=new SesionTransparencia();
$html=$sesion->creaSesionTransparencia();				
$respuesta["exito"]=1;
$respuesta["transparencia"]=$transparencia;
$respuesta["mensaje"]=$html;
echo json_encode($respuesta);
?>