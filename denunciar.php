<?php
    session_start();

    if(isset($_SESSION['user'], $_GET['idpost'], $_GET['idusuario'], $_GET['tipopost'])){
        include('config.php');
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
    }else{
        if (isset($_SESSION['user'])){
            header("Location: homeUsuarioWeb.php");
        }
        header("Location: homeInvitado.php");
    }


?> 