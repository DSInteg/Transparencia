<?php
/*
 * modelo_sesion.php 1.0  02/08/2017
 * Copyright (c) 2017 DSIntec, Inc.
 * Juan Jose Cordova Zamorano
 * e:jcordova@dsinteg     t: @che_chino
 */
require_once('logicavista.php');
require_once('modelo_area.php');
require_once('modelo_empleado.php');
require_once('item_renglon_documento.php');


/**
 * Clase Sesion:  crea el código HTML de la sesión 
 * 
 * @version 1.0 02/08/2017
 * @author Juan Jose Cordova Zamorano  		
 * 
 */
class ControlSesion  {
	private $idEmpleado;
	private $arrayEmpleado = array(
			'idUsuario' => '', 
			'idEmpleado' => '',
			'idArea' => '',
			'nombre' => '',
			'paterno' => '',
			'materno' => '',
			'email' => '');
	private	$arrayArea = array(
			'idArea' => '',
			'nombreArea'=>''
		);

	//Para el proyecto de Apizaco solo aremos el constructor leyendo un empleado, 
	//Posteriormente debemos crear el constuctor sin entrada
	function __construct($idEmpleado) {
		$this -> idEmpleado = $idEmpleado;

	}

	function creaSesion($idEmpleado){
		//obtiene información del Empleado
		$Empleado=new Empleado($idEmpleado);
		$this->arrayEmpleado=$Empleado->getEmpleado();
		$idArea=$Empleado -> getEmpleadoIdArea();
		$Area = new Area($idArea);
		$this->arrayArea=$Area->getArea();
		$archivoJavaScript="<script src='js/usuarioArea.js'></script>";
		if ($idArea==1){ $archivoJavaScript="<script src='js/usuarioUnidadTransparencia.js'></script>";}		
		$html="";
		$html=$this->creaSesionAreaObligada($idArea);
		$html = str_replace('{nombreArea}', $Area->getNombreArea(),$html);
		$html = str_replace('{nombreUsuario}', $Empleado ->getNombreCompletoEmpleado(),$html);
		$html = str_replace('{archivoJavaScript}', $archivoJavaScript,$html);
		return $html;
	}	

	public function creaSesionAreaObligada($idArea){
		$item=new ItemRenglonDocumento;
		$datos=$item->getDocumentosAreaTotalEstatus($idArea);
		$creavista= new vista();
		$html = $creavista->get_template('admin');
		$plantillaRenglonDocumento = $creavista->get_template('renglon');
		$listaItems="";
		for($i=0;$i<count($datos);$i++){
			$classEstatusDocumento="";
			$classPEstatusDocumento="";
			$listaItems=$listaItems.$plantillaRenglonDocumento;
			$listaItems = str_replace('{idDocumento}', $datos[$i]["idDocumento"],$listaItems);
			$listaItems = str_replace('{nomenclaturaFraccion}', $datos[$i]["nomenclaturaFraccion"],$listaItems);
			$listaItems = str_replace('{nombreFraccion}', $datos[$i]["nombreFraccion"],$listaItems);
			$listaItems = str_replace('{nombreDocumento}', $datos[$i]["nombreDocumento"],$listaItems);
			$listaItems = str_replace('{URL}', "https://".$datos[$i]["URL"],$listaItems);
			$listaItems = str_replace('{idSubeDocumento}', $datos[$i]["idSubeDocumento"],$listaItems);
			$listaItems = str_replace('{fechaSubeDocumento}', $datos[$i]["fechaSubeDocumento"],$listaItems);
			$listaItems = str_replace('{idApruebaDocumento}', $datos[$i]["idApruebaDocumento"],$listaItems);
			$listaItems = str_replace('{idASubedocumento}', $datos[$i]["idASubedocumento"],$listaItems);
			//$listaItems = str_replace('{EmpleadoApruebaDocumento}',$EmpleadoQ->searchNombreCompletoEmpleado($datos["idEmpleadoApruebaDocumento"][$i]),$listaItems);
			//$listaItems = str_replace('{fechaApruebaDocumento}', $datos["fechaApruebaDocumento"][$i],$listaItems);
			//$listaItems = str_replace('{EmpleadoSubeDocumento}',$EmpleadoQ->searchNombreCompletoEmpleado($datos["idEmpleadoSubeDocumento"][$i]),$listaItems);
			//Dependiendo el estatus del documento se coloca el botón adecuado aprobado, subir, aprobar, publicar
			//Si idDocumento=idSubeDocuemto=idApruebaDocumento=idPublicaDocumento, es un estado incial
			//Si idDocumento=idApruevaDocumento=idPublicaDocumento<>idSubeDocumento, entonces Espera Aprueba y Publica
			//Si idDocumento=idPublicaDocumento<>idSubeDocumento<>idApruevaDocumento, entonces Espera Publica
			//Si idDocumento<>idPublicaDocumento<>idSubeDocumento<>idApruevaDocumento, entonces Esperamos Subir nuevo Documento
			if (($datos[$i]["idDocumento"] == $datos[$i]["idSubeDocumento"]) &&
				($datos[$i]["idDocumento"] == $datos[$i]["idApruebaDocumento"]) && 
				($datos[$i]["idDocumento"] == $datos[$i]["idPublicaDocumento"])){
			$classEstatusDocumento='subir';
			}elseif (($datos[$i]["idDocumento"] != $datos[$i]["idSubeDocumento"]) &&
				($datos[$i]["idDocumento"] == $datos[$i]["idApruebaDocumento"]) && 
				($datos[$i]["idDocumento"] == $datos[$i]["idPublicaDocumento"])) {
				//$idArea=1 es la unidad de transparencia, 
				//se muestran botones de aprobación y publicación
				if ($idArea==1){ $classEstatusDocumento='aprobar';
				}else{ $classEstatusDocumento='subido';}
			}elseif (($datos[$i]["idDocumento"] != $datos[$i]["idSubeDocumento"]) &&
				($datos[$i]["idDocumento"] != $datos[$i]["idApruebaDocumento"]) && 
				($datos[$i]["idDocumento"] == $datos[$i]["idPublicaDocumento"])) {
				if ($idArea==1){ 
					$classEstatusDocumento='aprobado';
					$classPEstatusDocumento='publicar';
				}else{ $classEstatusDocumento='subido';}
			}elseif (($datos[$i]["idDocumento"] != $datos[$i]["idSubeDocumento"]) &&
				($datos[$i]["idDocumento"] != $datos[$i]["idApruebaDocumento"]) && 
				($datos[$i]["idDocumento"] != $datos[$i]["idPublicaDocumento"])) {
				if ($idArea==1){ 
					$classEstatusDocumento='aprobado';
					$classPEstatusDocumento='publicado';
				}else{ $classEstatusDocumento='subido';}				
			}
			$listaItems = str_replace('{classEstatusDocumento}', $classEstatusDocumento,$listaItems);
			$listaItems = str_replace('{classEstatusPublicaDocumento}', $classPEstatusDocumento,$listaItems);
		}
		$html = str_replace('{arregloItems}', $listaItems,$html);
		return $html;
	}
	
	
	public function getDatos(){
		$datos=array(
			"Empleado" =>  $this -> arrayEmpleado,
			"Area" =>  $this -> arrayArea
			);
		return $datos;
	}


}
?>