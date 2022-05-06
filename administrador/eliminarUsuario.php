<?php 
include('../api/config.php');
$idPost =  $_GET["id"];

$sql1 = "DELETE  FROM usuario WHERE id = '$idPost' ";
$result=$connection->query($sql1);
$connection->close();

header("Location: usuario.php");
?> 