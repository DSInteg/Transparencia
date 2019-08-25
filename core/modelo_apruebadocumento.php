<?php
/**
 * Copyright (c) 2017 DSIntec, Inc.
 * modelo_documento.php 
 */

require_once('modelo_dblogin.php');
require_once('modelo_subedocumento.php');

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

class ApruebaDocumento extends DBAbstractModelUsuarioLogin {
	private $idApruebaDocumento;
	private $idDocumento; //
	private $idSubeDocumento;
	private $idUsuario;
	private $siteURL;
	private $fecha;

	function __construct() {
	}	
	

	public function apruebaDocumentoTransparencia($idDocumento,$idUsuario){
		$this->idDocumento=$idDocumento;
		$subedoc=new SubeDocumento();
		$resultado=$subedoc->obtieneUltimoSubeDocumentoTransparencia($idDocumento);
		$this->query = "
			INSERT INTO apruebadocumento (idSubeDocumento, idUsuario, fecha)
			VALUES (".$resultado[0]['idSubeDocumento'].", 
				".$idUsuario.",  
				CURRENT_TIMESTAMP
				);
			";
		$last_id=$this->execute_single_query();
		return $last_id;
	}
	
	
	/** Funcion que indica si existe una empresa con base en el idEmpresa **/
	public function existeApruebaDocumento($idDocumento){
		$this->query = "
				SELECT 		* 
				FROM		Documento
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