<?php
    function getFotoUsuario ( $idUsuario ){
        include('config.php');
        $sql= "SELECT foto  FROM usuario WHERE id = '$idUsuario' ";
        $result=$connection->query($sql);
        $row = $result->fetch_assoc();
        $row = $row["foto"];
        return $row;
    }

    function addUsuario($nombre, $apellidos, $email, $dir, $fecha, $con_hash, $fecha_act){
        include "config.php";
        $sql ="INSERT INTO usuario(id,email,fecha_nacimiento,fecha_registro,
                                        contrasena,ubicacion,foto,activo,rol,nombre,apellidos) 
        VALUES (null,?,?,?,?,?,'imagenes/fotoPerfilGenerica.png',
                0,1,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssssss", $email, $fecha, $fecha_act, $con_hash, $dir, $nombre, $apellidos);
        $result = $stmt->execute() or trigger_error("Query: $sql\n<br />MySQL Error: " . mysqli_error($connection));
        return $result;
    }

    function verifyEmail($email){
        include "config.php";
        $sql="SELECT * FROM usuario WHERE email=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return (mysqli_num_rows($result)==0);

    }

    function verifyPassword($email, $password){
        include 'config.php';
        $sql = "SELECT * FROM `usuario` WHERE `email` = ? AND `contrasena` = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute() or trigger_error("Query: $sql\n<br />MySQL Error: " . mysqli_error($connection));
        $result = $stmt->get_result();
        return $result;
    }
?>