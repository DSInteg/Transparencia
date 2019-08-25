<?php
/*
 * item_renglon_documento.php 1.0  05/08/2017
 * Copyright (c) 2017 DSIntec, Inc.
 * Juan Jose Cordova Zamorano
 * e:jcordova@dsinteg     t: @che_chino
 */
require_once('modelo_dblogin.php');
/**
 * Clase ItemRenglonDocumento:  crea el código HTML de los Items de Documentos
 * Metodos contenidos en esta clase:
 *
 * @copyright Derechos reservados DSInteg				  
 * @version 1.0 04/10/2017
 * @author Juan Jose Cordova Zamorano
 * @author 	e:jcordova@dsinteg     t: @che_chino
 * @link http://dsinteg.com	
 * 
 */
class DocumentosTransparencia extends DBAbstractModelUsuarioLogin  {
	private $arrayItem = array(
		'idDocumento' =>0,
		'nomenclaturaFraccion' =>'',
		'nombreFraccion' =>'',
		'nombreDocumento' =>'',
		'URL' =>'',
		'idSubeDocumento' =>0,
		'empleadoSubeDocumento' =>'',
		'fechaSubeDocumento' =>'',
		'idApruebaDocumento' =>0,
		'idSubeDocumento' =>0,
		'idPublicaDocumento' =>0,
		'idEmpleadoApruebaDocumento' =>'',
		'fechaApruebaDocumento' =>'');


/**
* getDocumentosAreaTotalEstatus obtiene listado de todos los documenos del area
*
* A partir de idArea se obtiene el listado de todos los documentos que el area
* ha subido, tiene publicado o no ha subido tal como se publicará en el portal de
* administración.
*
* @return arreglo de (id)
* @param $idArea clave del area
*/
	public function getDocumentosTransparencia($idArticulo){
		$this->query="SELECT * FROM documentostransparencia
		where idArticulo=".$idArticulo.";";
		$this->get_results_from_query();
		if (count($this->rows) > 0 ):
			$aItem=array();
			for ($i=0;$i<count($this->rows);$i++ ){		
					$aItem[] = array(
						'idDocumento' =>$this->rows[$i]["idDocumento"],
						'idPublicaDocumento' =>$this->rows[$i]["idPublicaDocumento"],
						'idSubeDocumento' =>$this->rows[$i]["idSubeDocumento"],
						'nombreDocumento' =>$this->rows[$i]["nombreDocumento"],	
						'siteURL' =>$this->rows[$i]["siteURL"],					
						'nomenclaturaArticulo' =>$this->rows[$i]["nomenclaturaArticulo"],
						'nombreFraccion' =>$this->rows[$i]["nombreFraccion"]									
						);};
			return $aItem;
		else:
			return false;
		endif;
	}	
}
?>