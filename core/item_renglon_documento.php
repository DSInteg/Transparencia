<?php
/*
 * item_renglon_documento.php 1.0  05/08/2017
 * Copyright (c) 2017 DSIntec, Inc.
 * Juan Jose Cordova Zamorano
 * e:jcordova@dsinteg     t: @che_chino
 */
require_once('logicavista.php');
require_once('modelo_dblogin.php');


/**
 * Clase ItemRenglonDocumento:  crea el código HTML de los Items de Documentos
 * Metodos contenidos en esta clase:
 *
 * @copyright Derechos reservados DSInteg				  
 * @version 1.0 05/08/2017
 * @author Juan Jose Cordova Zamorano
 * @author 	e:jcordova@dsinteg     t: @che_chino
 * @link http://dsinteg.com	
 * 
 */
class ItemRenglonDocumento extends DBAbstractModelUsuarioLogin  {
	private $idArea;
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
	public function getDocumentosAreaTotalEstatus($idA){
		$query="";
		if(1==$idA){$query="select * from documentosareatotalestatus";
			}else{$query="select * from documentosareatotalestatus where idArea=".$idA; };
		$this->query=$query;
		$this->get_results_from_query();
		if (count($this->rows) > 0 ):
			$aItem=array();
			for ($i=0;$i<count($this->rows);$i++ ){		
					$aItem[] = array(
						'idDocumento' =>$this->rows[$i]["DidDocumento"],
						'nomenclaturaFraccion' =>$this->rows[$i]["AFnomenclaturaFraccion"],
						'nombreFraccion' =>$this->rows[$i]["AFnombreFraccion"],
						'nombreDocumento' =>$this->rows[$i]["DnombreDocumento"],
						'URL' =>$this->rows[$i]["SDsiteURL"],
						'idSubeDocumento' =>$this->rows[$i]["SDidSubeDocumento"],
						'idEmpleadoSubeDocumento' =>$this->rows[$i]["SDidUsuario"],
						'fechaSubeDocumento' =>$this->rows[$i]["SDfecha"],
						'idApruebaDocumento' =>$this->rows[$i]["ADidApruebaDocumento"],
						'idSubeDocumento' =>$this->rows[$i]["SDidSubeDocumento"],
						'idPublicaDocumento' =>$this->rows[$i]["PDidPublicaDocumento"],
						'idEmpleadoApruebaDocumento' =>$this->rows[$i]["ADidUsuario"],
						'fechaApruebaDocumento' =>$this->rows[$i]["ADfecha"]);};
			return $aItem;
		else:
			return false;
		endif;
	}	
}
?>