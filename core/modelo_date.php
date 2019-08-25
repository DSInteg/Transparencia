<?php
/**
 * Copyright (c) 2017 DSIntec, Inc.
 * modelo_documento.php 
 */

require_once('modelo_dblogin.php');

/**
 * Clase Documento: hace un modelo a la tabla "Documento"
 *
 * La tabla Documento contiene todos los documentos que 
 * el sujeto obligado debe actualizar con cierta periodicidad
 *  | Documento
 *	| int idDocumento
 *	| varchar(145) nombreDocumento
 *	| int periodo
 *
 * @copyright Derechos reservados DSInteg				  
 * @version 1.0 02/08/2017
 * @author Juan Jose Cordova Zamorano
 * @author 	e:jcordova@dsinteg     t: @che_chino
 * @link http://dsinteg.com	
 * 
 */

class DateMYSQL extends DBAbstractModelUsuarioLogin {
	private $idDocumento; //
	private $idSubeDocumento;
	private $idUsuario;
	private $siteURL;
	private $fecha;

	function __construct() {
	}		

	public function getDate(){
		
		$this->query = "SELECT CURRENT_TIMESTAMP;"; 			
		$this->get_results_from_query();
		if (count($this->rows) > 0 ):			
			return $this->rows[0];	
		else:
			return false;				
		endif;		
	}
}
?>