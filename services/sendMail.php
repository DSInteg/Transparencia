<?php

require_once('../core/funcionesGenerales.php');
extract($_POST);

switch ($accion) {
	case 'enviarCorreo':
			$exito 		= false;
			$htmlMail = cuerpoCorreo($nameReceiver,$greetingContent,$messageContent,$sendOffContent,$emailFooterContent);
			$correoEnviado = enviarEmail("dsintegmx@gmail.com",$email,$ccpAccount,u8($subjectContent),u8($htmlMail));
			if ($correoEnviado == 1) {
				$exito = true;
				$correoEnviado = 1;
			}else{
			$correoEnviado = 0;
		}
		$respuesta = array("Enviado" => $correoEnviado, "exito" => $exito);
	break;
}
echo json_encode($respuesta);
?>
