<?php
    session_start();
    include("config.php");

    $user = $_SESSION['user'];
    $idpost =  $_GET["idpost"];
    $sql_id_usuario_post = "SELECT usuario FROM post_encontrado WHERE id = '$idpost';";
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
