<?php 
include('../api/config.php');
$idPost =  $_GET["id"];
$idPost = intval($idPost);
$sql1 = "DELETE  FROM post_encontrado WHERE id = $idPost ";
$result=$connection->query($sql1);
$sql2 = "DELETE  FROM foto_post_encontrado WHERE post = $idPost ";
$result2=$connection->query($sql2);
$sql3 = "DELETE  FROM denuncia WHERE id_post = $idPost ";
$result3=$connection->query($sql3);
$connection->close();
header("Location: postEncontrados.php");
?> 