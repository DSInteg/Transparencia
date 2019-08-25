<?php
//DSInteg
//JJCZ
/*
	modelo_login.php
	Contiene la clase LoginUsuario, que verifica si exite un 
	usuario para hacer login en el sistema
	metodo:
			boolen:login($usuario, $password)
*/

//Requiere cargar el modelo abstracto de la base de datos login
require_once('modelo_dblogin.php');

//Clase Usuario Login
class UsuarioLogin extends DBAbstractModelUsuarioLogin {
	private $usuario,$password,$idCliente,$idUsuario;
private $arrayUsuario = array(
			'idUsuario' => '', 
			'idEmpleado' => '',
			'idArea' => '',
			'usuario' => '');

	public function registrarUsuario($id,$usr,$pwd,$idCli){
		$this->query = "
			INSERT INTO usuario (idUsuario,usuario, password,idCliente)
			VALUES ($id,'$usr','$pwd',$idCli)";		
			$this->execute_single_query();

	}

	public function setLogin($usuario, $password) 
	{
		$this->query = "SELECT  
				* 
				FROM
				usuario
				WHERE usuario='".strip_tags($usuario)."' 
				AND
				password='".strip_tags($password)."';";
				
		$this->get_results_from_query();

		if(count($this->rows)>0){
			$this->arrayUsuario= array('idUsuario' => $this->rows[0]["idUsuario"],
										'idEmpleado'=> $this->rows[0]["idEmpleado"],
										'idArea'=> $this->rows[0]["idArea"],
										'idUsuario'=> $this->rows[0]["usuario"] );
			return true;
		 }else{
			return false;
		 }
	}
	
	public function cambiarPwd($usr,$pwd,$idCli){
		$this->query = "
			update Usuario 
					set password='".$pwd."'
			where	usuario='".$usr."'
					and idCliente=".$idCli;
			$this->execute_single_query();
		
			return $this->query;

	}

	public function getIdEmpleado(){
		return $this->arrayUsuario['idEmpleado'];
	}

}
?>