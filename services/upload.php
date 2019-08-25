<?php
$respuesta='';
$respuesta["exito"]=0;
if ($_FILES['file']["error"] > 0){
  $respuesta["mensaje"]="1";
 }else{
  	//echo "Nombre: " . $_FILES['archivo']['name'] . "<br>";
  	//echo "Tipo: " . $_FILES['archivo']['type'] . "<br>";
  	//echo "Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";
  	//echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name'];
  if($_FILES['file']['type']=="application/msword" || 
    $_FILES['file']['type']=="application/excel" ||
    $_FILES['file']['type']=="application/pdf" || 
    $_FILES['file']['type']=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || 
    $_FILES['file']['type']=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
    $filename=str_replace(' ', '', $_FILES['file']['name']);
    $url_doc=$_SERVER['DOCUMENT_ROOT']."/transparencia/subidas/".str_replace(' ', '',$_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'],$url_doc);
    $url_publico=$_SERVER["HTTP_HOST"]."/transparencia/subidas/".str_replace(' ', '',$_FILES['file']['name']);
    $respuesta["exito"]=1;
    $respuesta["url"]="http://".$url_publico;    
  }else{
    $respuesta["exito"]=0;
    $respuesta["mensaje"]="error";
    $respuesta["url"]="TIPO DE ARCHIVO NO PERMITIDO";   
  }								
}
echo json_encode($respuesta);
?>