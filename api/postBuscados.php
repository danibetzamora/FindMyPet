<?php
    if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");
    function getListPost(){
        include('config.php');
        $sql="SELECT post_buscar.ubicacion,  post_buscar.fecha,
                 post_buscar.descripcion,post_buscar.nombre, usuario.nombre, usuario.apellidos,
                 usuario.foto, post_buscar.id
            FROM post_buscar 
            JOIN usuario WHERE usuario.id=post_buscar.usuario ORDER BY post_buscar.fecha desc ";
        $result=$connection->query($sql);

        $sql2="SELECT *
            FROM post_buscar
            JOIN foto_post_buscado WHERE post_buscar.id=foto_post_buscado.post ORDER BY post_buscar.fecha desc";
        $result2=$connection->query($sql2);
        return [$result,$result2];
       
    }
    function getPost(){

    }
    function addPost($animal,$raza,$sexo,$nombre,$direccion,$descripcion,$fecha,$upload,$idUsuario,$adress){
        include('config.php');
        $q="INSERT INTO post_buscar(id,animal,raza,nombre,sexo,fecha,ubicacion,descripcion,usuario) VALUES (null,'$animal','$raza','$nombre','$sexo','$fecha','$direccion','$descripcion','$idUsuario')"; 
        $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
        $qid ="SELECT id FROM post_buscar WHERE usuario='$idUsuario' and fecha ='$fecha'";
        $r = mysqli_query ($connection, $qid) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
        $idPost=$r->fetch_assoc();
        $idPost =$idPost["id"];
    
        if (move_uploaded_file($_FILES['fotos']['tmp_name'], $upload)) {
            $pathPhoto = $adress . $_FILES['fotos']['name'] ;
            $query = $connection->query("INSERT INTO foto_post_buscado VALUES (null ,$idPost,'$pathPhoto') ");
            header("Location: buscados.php");
    
        } 
    }

?>