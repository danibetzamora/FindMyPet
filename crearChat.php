<?php
    session_start();
    include("api/config.php");

    if (isset($_SESSION['user']) && isset($_GET['idpost'])){
        $user = $_SESSION['user'];
        $idpost =  $_GET["idpost"];
        $tabla = $_SESSION['urlChat'];
        $sql_id_usuario_post = "SELECT usuario FROM $tabla WHERE id = '$idpost';";
        $result = $connection->query($sql_id_usuario_post);
        while ($row = $result -> fetch_array()){
            $id_usuario = $row['usuario'];
        }
        $date = date('Y-m-d h:i:s', time());
        $sql = "INSERT INTO chat (fecha, usuario_uno, usuario_dos) VALUES ('$date', '$user[0]', '$id_usuario')";

        $result = $connection->query($sql);

        $connection->close();

        if($result){
            header("Location: chat.php");
        }
    }else{
        header("Location: homeInvitado.php");
    }


