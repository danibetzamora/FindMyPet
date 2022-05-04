<?php 
include('../api/config.php');
$idPost = intval($_GET["id"]);
$sql1 = "DELETE  FROM post_buscar WHERE id = '$idPost' ";
$result=$connection->query($sql1);
$sql2 = "DELETE  FROM foto_post_buscado WHERE post = '$idPost' ";
$result2=$connection->query($sql2);
$sql3 = "DELETE  FROM denuncia WHERE id_post = '$idPost' ";
$result3=$connection->query($sql3);
$connection->close();
header("Location: postBuscados.php");
?> 