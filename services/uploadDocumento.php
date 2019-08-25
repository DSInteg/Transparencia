<?php
$respuesta='';
$respuesta["exito"]=0;
if ($_FILES['file']["error"] > 0){
  $respuesta["mensaje"]="1";
 }else{
  	$url_doc=$_SERVER['DOCUMENT_ROOT']."/transparencia/documentostransparencia/".$_FILES['file']['name'];
	move_uploaded_file($_FILES['file']['tmp_name'],$url_doc);
	$url_publico=$_SERVER["HTTP_HOST"]."/transparencia/documentostransparencia/".$_FILES['file']['name'];
	$respuesta["exito"]=1;
	$respuesta["url"]=$url_publico;									
}
echo json_encode($respuesta);
?>