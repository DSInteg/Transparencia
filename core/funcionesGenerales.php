<?php

	require_once('PHPMailer/PHPMailerAutoload.php');
	function obtenerFechaActual(){
	    date_default_timezone_SET('AMERICA/Mexico_City');
	    $fechaActual = date('Y-m-d G:i:s');
	    return $fechaActual;
	}

	function obtenerFechaLimite(){
	   date_default_timezone_SET('AMERICA/Mexico_City');
	    $fechaActual = date('Y-m-d G:i:s');
		$fechaLimite = date('Y-m-d G:i:s', strtotime("$fechaActual + 7 days"));
	    return $fechaLimite;
	}


	function u8($palabra){
		$palabra = utf8_decode($palabra);
		return $palabra;
	}

	function enviarEmail($remitente,$destinatario,$ccp,$Asunto,$html)
	{
		$correo = new PHPMailer();

		$correo->IsSMTP(); 												// Indicamos que usaremos el script SMTP
		$correo->SMTPAuth = true; 										// Activamos la autenticación SMTP
		$correo->SMTPSecure = 'tls';									// Especificamos la seguridad de la conexion en este caso TLS, tmabien puede ser "ssl"
		$correo->Host = "mail.dsinteg.com"; 								// usuario del servidor SMTP
		$correo->Port = 587;											// Especificamos el puerto del servidor SMTP
		$correo->Username = 'infoventas@dsinteg.com'; // Usuario del servidor SMTP
		$correo->Password = '$PCymT8Z}QN6';                                 // Contraseña del usuario SMTP
		$correo->SetFrom("infoventas@dsinteg.com", "DSInteg: Desarrollo de Sistemas Inteligentes"); 			// Especificamos quien envia el correo
		$correo->AddAddress($destinatario, "Usuario");
		$correo->addCC($ccp); 					// Especificamos la cuenta destino
		$correo->Subject = $Asunto; 									// colocamos el asunto del mensaje
		$correo->MsgHTML($html);										// Si deceamos enviar un correo con formato html utilizamos MsgHTML
		$correo->SMTPOptions = array(
	    'ssl' => array(
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
	        )
	    );

		if(!$correo->Send()) {
		return $enviado = 0;
		} else {
			return $enviado = 1;
		}
	}

	function formateaFecha($fecha){
	    $fechaFormateada = strtotime($fecha);
	    $fechaFinal= date("d/m/Y", $fechaFormateada);
	    return $fechaFinal;
	}

	function cuerpoCorreo($nameReceiver,$greetingContent,$messageContent,$sendOffContent,$emailFooterContent){
		$html = '
		<!DOCTYPE html>
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		</head>
		<body style="background: #f9f9f9;font-family: sans-serif;">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		    <tr>
		        <td align="center">
		          <div class="content" style="background: #fff;max-width: 620px;margin: 0 auto;border: 1px solid #e3e3e3;text-align: left;margin-top: 60px;">
		            <img src="http://dsinteg.com/img/email_banner.jpg" alt="" style="border-bottom: 1px solid #f1f1f1;">
		            <div class="message" style="height: auto;padding: 20px 20px 10px 20px;">
		              <span style="color: #595959;font-family: sans-serif;font-size: 12pt;font-weight: 700;">'.$nameReceiver.'</span>
		              <p style="margin: 15px 0;color: #6b6b6b;font-size: 11pt;">'.$greetingContent.'</p>
		              <div class="messageBox" style="background: #f3f3f3;padding: 15px;max-width: 95%;margin: 10px auto;">
		                <div class="mensaje-correo" style="font-size: 11pt;">
		                  <p style="margin: 15px 0;color: #6b6b6b;font-size: 11pt;">'.$messageContent.'</p>
		                </div>
		              </div>
		              <div class="despedida" style="margin: 15px 0;color: #6b6b6b;font-size: 11pt;">'.$sendOffContent.'</div>
		              <p style="margin: 15px 0;color: #6b6b6b;font-size: 11pt;">'.$emailFooterContent.'</p>
		            </div>
		          </div>
		          <div class="info" style="max-width: 620px;text-align: center;margin: 30px auto;">
								<p style="font-family: sans-serif;color: #c1c1c1;font-size: .9em; margin-bottom:10px;">DSInteg</p>
                <p style="font-family: sans-serif;color: #c1c1c1;font-size: .9em; margin-bottom:10px;">www.dsinteg.com</p>
                <span style="font-family: sans-serif;color: #c1c1c1;font-size: .9em;">Cualquier duda o sugerencia por favor escribenos a comunicacion@dsinteg.com</span>
		          </div>
		        </td>
		    </tr>
		  </table>
		</body>
		</html>
        ';
		return $html;
	}

?>
