<?php 
include('config.php');
$idPost =  $_GET["idpost"];
$idUsario =  $_GET["idusuario"];
$tipoPost =  $_GET["tipopost"];
$sql1 = "INSERT INTO denuncia(id,date,id_post,id_usuario,tipo_post) VALUES(null,null,'$idPost','$idUsario','$tipoPost')";
$result=$connection->query($sql1);
$connection->close();

header("Location: postBuscados.php");
?> 