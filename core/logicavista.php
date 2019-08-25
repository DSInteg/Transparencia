<?php
/*
 * logicavista.php 1.0  02/08/2017
 * Copyright (c) 2017 DSIntec, Inc.
 * Juan Jose Cordova Zamorano
 * e:jcordova@dsinteg     t: @che_chino
 */
require_once('modelo_dblogin.php');


class vista extends DBAbstractModelUsuarioLogin {
	function get_template($file) {
		//En algun momento lo vamos a hacer sin código duri
		//$file = MODULOHTML;
		$template = $this -> obtenerHTML($file);
		return $template;
	}

	function render_dinamic_data($html, $data) {
		foreach ($data as $clave=>$valor) {
			$html = str_replace('{'.$clave.'}', $valor, $html);
		}
		return $html;
	}

	public function obtenerHTML($getfile){
		$this->query = "
				SELECT 		html
				FROM		vistahtml
				WHERE 		template='".$getfile.
				"';";	 
			
		$this->get_results_from_query();
		//if(mysqli_num_rows($result)>0):
		if (count($this->rows) > 0 ):
			return $this->rows[0]['html'];
		else:
			return false;
		endif;		
	}	
	public function get_template_file($form='get') {
		$file = $_SERVER['DOCUMENT_ROOT']."/tapizaco/transparencia/html/".$form.'.html';
		$template = file_get_contents($file);
		return $template;
	}	
}
?>