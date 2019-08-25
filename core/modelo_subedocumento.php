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

class SubeDocumento extends DBAbstractModelUsuarioLogin {
	private $fecha;

	function __construct() {
	}	
	
	public function subeDocumentoTransparencia($idDocumento,$idUsuario,$URL){
		$this->idDocumento=$idDocumento;
		$this->query = "
			INSERT INTO subedocumento (idDocumento, idUsuario, siteURL,fecha)
			VALUES (".$idDocumento.", 
					".$idUsuario.",  
					'".$URL."',
					CURRENT_TIMESTAMP
					);
			";

			$last_id=$this->execute_single_query();
			return $last_id;
	}	

	public function obtieneUltimoSubeDocumentoTransparencia($idDocumento){
		$this->idDocumento=$idDocumento;
		$ultimoIdSubeDocumento=0;		
		$this->query = "
			SELECT 	max(idSubeDocumento) as idSubeDocumento, idDocumento, idUsuario, siteURL, fecha 
			FROM		subedocumento
			WHERE 		idDocumento=".$idDocumento.";"; 			
		$this->get_results_from_query();
		//if(mysqli_num_rows($result)>0):

		if (count($this->rows) > 0 ):
				$resultado=array();
				$resultado[]=array(	'idSubeDocumento' => $this->rows[0]["idSubeDocumento"],
									'idDocumento' => $this->rows[0]["idDocumento"],
									'idUsuario' => $this->rows[0]["idUsuario"],
									'siteURL' => $this->rows[0]["siteURL"],
									'fecha' => $this->rows[0]["fecha"]
										);			
			return $resultado;	
		else:
			return false;				
		endif;		
	}
	
	/** Funcion que indica si existe una empresa con base en el idEmpresa **/
	public function existeSubeDocumento($idDocumento){
		$this->query = "
				SELECT 		* 
				FROM		documento
				WHERE 		idDocumento='".$idDocumento."';"; 
				
		$this->get_results_from_query();
		//if(mysqli_num_rows($result)>0):
		if (count($this->rows) > 0 ):
			foreach ($this->rows[0] as $propiedad=>$valor):
				$this->$propiedad = $valor;
			endforeach;
			return true;
		else:
			return false;
		endif;		
	}	



}
?>