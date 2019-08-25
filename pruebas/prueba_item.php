<?php
/*
 * Pruebas.php 1.0  06/09/2017
 * Copyright (c) 2017 DSIntec, Inc.
 */

require_once('../core/item_renglon_documento.php');


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
$idArea=1;
$item=new ItemRenglonDocumento;
$datos=$item->getDocumentosAreaTotalEstatus($idArea);

//echo count($datos[0]);
echo $datos[1]['idDocumento'];
echo count($datos);
/*
foreach ($datos as $indice => $valor) {
      echo $indice;
      //var_dump($valor);
}
*/
echo json_encode($datos);
?>