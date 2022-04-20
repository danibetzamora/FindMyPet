<?php 
include('../config.php');
$idPost =  $_GET["id"];

$sql1 = "DELETE  FROM post_buscar WHERE id = '$idPost' ";
$result=$connection->query($sql1);
$connection->close();
$sql2 = "DELETE  FROM foto_post_buscado WHERE post = '$idPost' ";
$result2=$connection->query($sql2);
$connection->close();

header("Location: postBuscados.php");
?> 