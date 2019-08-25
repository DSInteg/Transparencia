<?php
/*
 * modelo_area.php 1.0  05/08/2017
 * Copyright (c) 2017 DSIntec, Inc.
 * Juan Jose Cordova Zamorano
 * e:jcordova@dsinteg     t: @che_chino
 */

require_once('modelo_dblogin.php');

/**
 * Clase Area: clase que tiene todas las operaciones con Area
 *
 * Metodos contenidos en esta clase:
 *
 * @copyright Derechos reservados DSInteg				  
 * @version 1.0 05/08/2017
 * @author Juan Jose Cordova Zamorano
 * @author 	e:jcordova@dsinteg     t: @che_chino
 * @link http://dsinteg.com	
 * 
 */

class Area extends DBAbstractModelUsuarioLogin {
	private $idArea; //
	private $nombreArea;
	function __construct($idArea) {
		$this->query="select idArea, nombreArea
						from area
						where idArea=".$idArea.";";
		$this->get_results_from_query();
		if (count($this->rows) > 0 ){
			$this->nombreArea=$this->rows[0]["nombreArea"];
			$this->idArea=$this->rows[0]["idArea"];		
		}else{
			$this->idArea=0;			
			$this->nombreArea=0;			
		} 		
	}	
/**
* getEmpleado obtiene el arreglo del empleado 
*
* Se obtienen los datos del empleado con el que se creó la clase
*
* @return arreglo 
* @param null
*/	
	public function getArea(){
		$arrayArea= array('idArea' => $this->idArea,
			'nombreArea' => $this->nombreArea);
		return $arrayArea;
	}
/**
* getEmpleado obtiene el arreglo del empleado 
*
* Se obtienen los datos del empleado con el que se creó la clase
*
* @return arreglo 
* @param null
*/	
	public function getNombreArea(){
		$arrayArea=  $this->nombreArea;
		return $arrayArea;
	}	
}
?>