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

class Documento extends DBAbstractModelUsuarioLogin {
	private $idDocumento; //
	private $nombreDocumento;
	private $periodo;

	function __construct() {
	}	
	
	/** Agrega un cliente a la tabla cliente **/
	public function agregaDocumento($idDocumento,$nombreDocumento, $periodo){
		$this->idDocumento=$idDocumento;
		$this->nombreDocumento=$nombreDocumento;
		$this->periodo=$periodo;
		$this->query = "
			INSERT INTO Documento (idDocumento, nombreDocumento, periodo)
			VALUES ('".$idDocumento."', 
					'".$nombreDocumento."',  
					'".$periodo."');
			";

			$this->execute_single_query();
	}

	public function subeDocumentoTransparencia($idDocumento,$idUsuario,$URL){
		$this->idDocumento=$idDocumento;
		$this->query = "
			INSERT INTO subeDocumento (idDocumento, idUsuario, siteURL,fecha)
			VALUES (".$idDocumento.", 
					".$idUsuario.",  
					'".$URL."',
					CURRENT_TIMESTAMP
					);
			";

			$this->execute_single_query();
	}	
	
	/*actualizamos los datos de la empresa*/
	/** Agrega un cliente a la tabla cliente **/
	public function actualizaDocumento($idCliente, $calle, $municipio, $estado, $telefono){
		$this->idCliente=$idCliente;
		$this->calle=$calle;
		$this->municipio=$municipio;
		$this->estado=$estado;
		$this->telefono=$telefono;
		
		$this->query = "
			update Empresa 
			set    calle='$calle', 
				   municipio='$municipio', 
				   estado='$estado', 
				   telefono='$telefono'
		    where idCliente = '$idCliente' ";

			$this->execute_single_query();
	}
	
	/** Funcion que indica si existe una empresa con base en el idEmpresa **/
	public function existeIdDocumento($idDocumento){
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