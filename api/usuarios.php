<?php
    if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");

    function getFotoUsuario ( $idUsuario ){
        include('config.php');
        $sql= "SELECT foto  FROM usuario WHERE id = '$idUsuario' ";
        $result=$connection->query($sql);
        $row = $result->fetch_assoc();
        $row = $row["foto"];
        return $row;
    }



?>