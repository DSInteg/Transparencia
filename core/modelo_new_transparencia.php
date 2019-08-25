<?php
/*
 * modelo_sesion.php 1.0  20/12/2017
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
		$html = $creavista->get_template_file('TEMPLATE');		
		$TITULO= $creavista->get_template_file('TITULO_DOCUMENTO');
		$BLOQUE_DOCUMENTO = $creavista->get_template_file('BLOQUE_DOCUMENTOS');
		$COLUMNA_IZQUIERDA = $creavista->get_template_file('COLUMNA_IZQUIERDA');
		$COLUMNA_DERECHA = $creavista->get_template_file('COLUMNA_DERECHA');
		$DOCUMENTO = $creavista->get_template_file('DOCUMENTO');
		$BLOQUEARTICULOS="";
		
		/* CODIGO DURO DOCUMENTOS A CARGAR SE DEBE EDITAR PARA AGREGAR NUEVOS BLOQUES */
		/* EN UNA VERSIÓN FUTURA SE DEBE LEER LA CONFIGURACIÓN VÍA UN DOC XML*/
		
		$ARTICULO=array("ARTICULO 63","ARTICULO 64"); //EN VERSIÓN FUTURA DEBE ESTAR EN XML
		$na=1; //VARIABLE DE APUNTA A ARTICULO 63=1; 64=2
		$item=new DocumentosTransparencia;
		for($na=1;$na<3;$na++){
			$datos=$item->getDocumentosTransparencia($na);		
			$listaItems="";		
			$NuDocIzq=ceil(count($datos)/2);
			$NuDocDer=floor(count($datos)/2);
			//Llenamos columna izquierda 
			
			for($i=0;$i<$NuDocIzq;$i++){
				$listaItems=$listaItems.$DOCUMENTO;
				$listaItems = str_replace('{siteURL}', "https://".$datos[$i]["siteURL"],$listaItems);
				$listaItems = str_replace('{nomenclaturaArticulo}', $datos[$i]["nomenclaturaArticulo"],$listaItems);
				$listaItems = str_replace('{nombreFraccion}', $datos[$i]["nombreFraccion"],$listaItems);
				//falta cargar la fecha de ultima publicación: el template queda fijo
				//$listaItems = str_replace('{FechaPublicacion}', $datos[$i]["nombreFraccion"],$listaItems);
			}
			$CI=$COLUMNA_IZQUIERDA;
			$CI=str_replace('{CONTENIDO_COLUMNA_IZQUIERDA}',$listaItems,$CI);
			$listaItems="";
			//llenamos columna derecha
			for($i=$NuDocIzq;$i<$NuDocIzq+$NuDocDer;$i++){
				$listaItems=$listaItems.$DOCUMENTO;
				$listaItems = str_replace('{siteURL}', "https://".$datos[$i]["siteURL"],$listaItems);
				$listaItems = str_replace('{nomenclaturaArticulo}', $datos[$i]["nomenclaturaArticulo"],$listaItems);
				$listaItems = str_replace('{nombreFraccion}', $datos[$i]["nombreFraccion"],$listaItems);
				//falta cargar la fecha de ultima publicación: el template queda fijo
				//$listaItems = str_replace('{FechaPublicacion}', $datos[$i]["nombreFraccion"],$listaItems);
			}
			$CD=$COLUMNA_DERECHA;
			$CD=str_replace('{CONTENIDO_COLUMNA_DERECHA}',$listaItems,$CD);
			$TI=$TITULO;
			$TI=str_replace('{ARTICULO}', $ARTICULO[$na-1],$TI);
			$BL=$BLOQUE_DOCUMENTO;
			$BL=str_replace('{TITULO_DOCUMENTO}',$TI,$BL);
			$BL=str_replace('{COLUMNA_IZQUIERDA}',$CI,$BL);
			$BL=str_replace('{COLUMNA_DERECHA}',$CD,$BL);
			$BLOQUEARTICULOS=$BLOQUEARTICULOS.$BL;
			}
		$html = str_replace('{BLOQUE_DOCUMENTOS}',$BLOQUEARTICULOS,$html);
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