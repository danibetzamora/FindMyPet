<?php
    session_start();
    include("api/config.php");
    include ("api/chat.php");
    if (isset($_SESSION['user']) && isset($_GET['idpost'])){
        $user = $_SESSION['user'];
        $idpost =  $_GET["idpost"];
        $tabla = $_SESSION['urlChat'];

        $id_usuario = getUsuarioPostId($idpost, $tabla);

        $result = createChat($user, $id_usuario);

        header("Location: chat.php");

    }else{
        header("Location: homeInvitado.php");
    }


