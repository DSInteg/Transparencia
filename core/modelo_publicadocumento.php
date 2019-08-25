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

class PublicaDocumento extends DBAbstractModelUsuarioLogin {
	private $idApruebaDocumento;
	private $idDocumento; //
	private $idSubeDocumento;
	private $idUsuario;
	private $siteURL;
	private $fecha;

	function __construct() {
	}	

	public function publicaDocumentoTransparencia($idDocumento,$idSubeDocumento,$idApruebaDocumento,$idUsuario){
		$this->idDocumento=$idDocumento;
		/* Si da tiempo verificar que es el último aprueba del sube, por esta versión la sacamos así
		$subedoc=new SubeDocumento();
		$resultado=$subedoc->obtieneUltimoSubeDocumentoTransparencia($idDocumento);
		*/
		$this->query = "
			INSERT INTO publicadocumento (idSubeDocumento, idApruebaDocumento,idUsuario, fecha)
			VALUES (".$idSubeDocumento.", 
				".$idApruebaDocumento.", 
				".$idUsuario.",  
				CURRENT_TIMESTAMP
				);
			";
		$last_id=$this->execute_single_query();
		return $last_id;
	}
}
?>