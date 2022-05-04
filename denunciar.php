<?php 
include('api/config.php');
$idPost =  $_GET["idpost"];
$idUsario =  $_GET["idusuario"];
$tipoPost =  $_GET["tipopost"];
$fechaGenerada= date('Y-m-d H:i:s'); 
$sql = "INSERT INTO denuncia(id,date_upload,id_post,id_usuario,tipo_post) VALUES(null,'$fechaGenerada','$idPost','$idUsario','$tipoPost')";
$result=$connection->query($sql);

$connection->close();
if ($tipoPost == 0){
header("Location: homeUsuarioWeb.php");
}else {
    header("Location: buscados.php");
}

?> 