<?php
/*
 * modelo_sesion.php 1.0  02/08/2017
 * Copyright (c) 2017 DSIntec, Inc.
 * Juan Jose Cordova Zamorano
 * e:jcordova@dsinteg     t: @che_chino
 */
require_once('logicavista.php');
require_once('DocumentosTransparencia.php');
/**
 * Clase Sesion:  crea el código HTML de la sesión 
 * 
 * @version 1.0 02/08/2017
 * @author Juan Jose Cordova Zamorano  		
 * 
 */
class SesionTransparencia  {
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
	function __construct() {
	}	

	public function creaSesionTransparencia(){
		$creavista= new vista();
		$html = $creavista->get_template('transparencia');
		$plantillaFraccion = $creavista->get_template('fraccion');
		$plantillaFraccion64=$plantillaFraccion;
		$renglonArticulo = $creavista->get_template('articulo');
		$item=new DocumentosTransparencia;
		//Obtenemos Datos para Articulo 63 donde idArticulo =1
		$datos=$item->getDocumentosTransparencia(1);		
		$listaItems="";
		for($i=0;$i<count($datos);$i++){
			$listaItems=$listaItems.$renglonArticulo;
			$listaItems = str_replace('{idDocumento}', $datos[$i]["idDocumento"],$listaItems);
			$listaItems = str_replace('{idPublicaDocumento}', $datos[$i]["idPublicaDocumento"],$listaItems);			
			$listaItems = str_replace('{idSubeDocumento}', $datos[$i]["idSubeDocumento"],$listaItems);
			$listaItems = str_replace('{siteURL}', "https://".$datos[$i]["siteURL"],$listaItems);
			$listaItems = str_replace('{nomenclaturaArticulo}', $datos[$i]["nomenclaturaArticulo"],$listaItems);
			$listaItems = str_replace('{nombreFraccion}', $datos[$i]["nombreFraccion"],$listaItems);
		}
		//Solo por hoy lo dejamos en código duro, pero para la sig versión debo modificarlo
		$plantillaFraccion = str_replace('{articulo}', "63",$plantillaFraccion);
		$plantillaFraccion = str_replace('{nombreArticulo}', "Articulo 63",$plantillaFraccion);
		$plantillaFraccion = str_replace('{listaFraccion}', $listaItems,$plantillaFraccion);
		$html = str_replace('{articulo63}', $plantillaFraccion,$html);
		unset($datos);
		//Obtenemos Datos para Articulo 64 donde idArticulo =2
		$datos=$item->getDocumentosTransparencia(2);		
		$listaItems="";
		for($i=0;$i<count($datos);$i++){
			$listaItems=$listaItems.$renglonArticulo;
			$listaItems = str_replace('{idDocumento}', $datos[$i]["idDocumento"],$listaItems);
			$listaItems = str_replace('{idPublicaDocumento}', $datos[$i]["idPublicaDocumento"],$listaItems);			
			$listaItems = str_replace('{idSubeDocumento}', $datos[$i]["idSubeDocumento"],$listaItems);
			$listaItems = str_replace('{siteURL}', "https://".$datos[$i]["siteURL"],$listaItems);
			$listaItems = str_replace('{nomenclaturaArticulo}', $datos[$i]["nomenclaturaArticulo"],$listaItems);
			$listaItems = str_replace('{nombreFraccion}', $datos[$i]["nombreFraccion"],$listaItems);
		}
		//Solo por hoy lo dejamos en código duro, pero para la sig versión debo modificarlo
		$plantillaFraccion64 = str_replace('{articulo}', "64",$plantillaFraccion64);
		$plantillaFraccion64 = str_replace('{nombreArticulo}', "Articulo 64",$plantillaFraccion64);
		$plantillaFraccion64 = str_replace('{listaFraccion}', $listaItems,$plantillaFraccion64);
		$html = str_replace('{articulo64}', $plantillaFraccion64,$html);
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