<?php
/*
 * modelo_empleado.php 1.0  05/08/2017
 * Copyright (c) 2017 DSIntec, Inc.
 * Juan Jose Cordova Zamorano
 * e:jcordova@dsinteg     t: @che_chino
 */

require_once('modelo_dblogin.php');

/**
 * Clase Empleadp: clase que tiene todas las operaciones con Empleado
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

class Empleado extends DBAbstractModelUsuarioLogin {
	private $idEmpleado; //
	private $nombre;
	private $paterno;
	private $materno;
	private $email;
	private $idUsuario;
	private $idArea;
	function __construct($idEmpleado) {
		$this->query="select U.idUsuario as UidUsuario, U.idArea as UidArea, E.idEmpleado as EidEmpleado, E.nombre as Enombre, E.paterno as Epaterno, E.materno as Ematerno, E.email as Eemail
						from empleado E, usuario U
						where E.idEmpleado=U.idEmpleado
							and E.idEmpleado=".$idEmpleado.";";
		$this->get_results_from_query();
		if (count($this->rows) > 0 ){
			$this->idEmpleado=$this->rows[0]["EidEmpleado"];
			$this->nombre=$this->rows[0]["Enombre"];
			$this->paterno=$this->rows[0]["Epaterno"];
			$this->materno=$this->rows[0]["Ematerno"];
			$this->email=$this->rows[0]["Eemail"];	
			$this->idUsuario=$this->rows[0]["UidUsuario"];	
			$this->idArea=$this->rows[0]["UidArea"];		
		}else{
			$this->idUsuario=0;			
			$this->idEmpleado=0;
			$this->idArea=0;			
			$this->nombre=0;
			$this->paterno=0;
			$this->materno=0;
			$this->email=0;			
		} 		
	}	
/**
* getEmpleadoIdArea obtiene el idArea al que perenece el empleado 
*
* Se obtienen idArea empleado del que se creó la clase
*
* @return arreglo 
* @param null
*/		
	public function getEmpleadoIdArea(){
		return $this->idArea;
	}
/**
* getEmpleado obtiene el arreglo del empleado 
*
* Se obtienen los datos del empleado con el que se creó la clase
*
* @return arreglo 
* @param null
*/	
	public function getEmpleado(){
		$arrayEmpleado= array(
			'idUsuario' => $this->idUsuario, 
			'idEmpleado' => $this->idEmpleado,
			'idArea' => $this->idArea,
			'nombre' => $this->nombre,
			'paterno' => $this->paterno,
			'materno' => $this->materno,
			'email' => $this->email);
		return $arrayEmpleado;
	}

/**
* getNombreCompletoEmpleado obtiene el arreglo del empleado 
*
* Se obtienen los datos del empleado con el que se creó la clase
*
* @return arreglo 
* @param null
*/	
	public function getNombreCompletoEmpleado(){
		$nombreCompleto=$this->nombre." ".$this->paterno." ".$this->materno;
		return $nombreCompleto;
	}	
/**
* searchNombreCompletoEmpleado busca y regresa el nombre completo de un empleado 
*
* Se buscan 
*
* @return arreglo 
* @param $idEmpleado
*/	
	public function searchNombreCompletoEmpleado($idEmpleado) {
		$this->query="select E.nombre, E.paterno, E.materno
						from Empleado E
						where E.idEmpleado=".$idEmpleado.";";
		$this->get_results_from_query();
		if (count($this->rows) > 0 ){
			$nombreCompleto=$this->rows[0]["E.nombre"]." ".$this->rows[0]["E.paterno"]." ".$this->rows[0]["E.materno"];
			return $nombreCompleto;		
		}else{
			return false;			
		} 		
	}
}