<?php
/*
 * Pruebas.php 1.0  06/09/2017
 * Copyright (c) 2017 DSIntec, Inc.
 */

require_once('../core/item_renglon_documento.php');
require_once('../core/logicavista.php');

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
$creavista= new vista();
$html = $creavista->get_template('admin');
$plantillaRenglonDocumento = $creavista->get_template('renglon');
$listaItems="";
for($i=0;$i<count($datos);$i++){
	$classEstatusDocumento="";
	$classPEstatusDocumento="";
	echo "Sube: ".$datos[$i]["idSubeDocumento"]."-Aprueba: ".$datos[$i]["idApruebaDocumento"]."-Publica: ".$datos[$i]["idPublicaDocumento"]."\n";
	$listaItems=$listaItems.$plantillaRenglonDocumento;
	if (($datos[$i]["idDocumento"] == $datos[$i]["idSubeDocumento"]) &&
		($datos[$i]["idDocumento"] == $datos[$i]["idApruebaDocumento"]) && 
		($datos[$i]["idDocumento"] == $datos[$i]["idPublicaDocumento"])){
	$classEstatusDocumento='.subir';
	}elseif (($datos[$i]["idDocumento"] != $datos[$i]["idSubeDocumento"]) &&
		($datos[$i]["idDocumento"] == $datos[$i]["idApruebaDocumento"]) && 
		($datos[$i]["idDocumento"] == $datos[$i]["idPublicaDocumento"])) {
		//$idArea=1 es la unidad de transparencia, 
		//se muestran botones de aprobación y publicación
		if ($idArea==1){ $classEstatusDocumento='.aprobar';
		}else{ $classEstatusDocumento='.subido';}
	}elseif (($datos[$i]["idDocumento"] != $datos[$i]["idSubeDocumento"]) &&
		($datos[$i]["idDocumento"] != $datos[$i]["idApruebaDocumento"]) && 
		($datos[$i]["idDocumento"] == $datos[$i]["idPublicaDocumento"])) {
		if ($idArea==1){ $classEstatusDocumento='.publicar';
		}else{ $classEstatusDocumento='.subido';}
	}elseif (($datos[$i]["idDocumento"] != $datos[$i]["idSubeDocumento"]) &&
		($datos[$i]["idDocumento"] != $datos[$i]["idApruebaDocumento"]) && 
		($datos[$i]["idDocumento"] != $datos[$i]["idPublicaDocumento"])) {
			$classEstatusDocumento='.subido';
			$classPEstatusDocumento='.publicado';
	}
	$listaItems = str_replace('{classEstatusDocumento}', $classEstatusDocumento,$listaItems);
	$listaItems = str_replace('{classEstatusPublicaDocumento}', $classPEstatusDocumento,$listaItems);
	echo $listaItems."\n";
}
?>