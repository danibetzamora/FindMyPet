<?php
    if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");
    function getListPost(){
        include('config.php');
        $sql = "SELECT post_buscar.*, usuario.nombre, usuario.apellidos,
                 usuario.foto AS UsuarioFoto, foto_post_buscado.foto AS PostFoto
            FROM post_buscar 
            JOIN usuario ON usuario.id=post_buscar.usuario 
            JOIN foto_post_buscado WHERE post_buscar.id=foto_post_buscado.post";
        $filters = [];
        $param = "";
        if(isset($_POST["animal"])) {
            $animal = $_POST["animal"];
            $filters[] = $animal;
            $param.="s";
            $sql.=" AND post_buscar.animal=? ";
        }
        if(isset($_POST["raza"])) {
            $raza = $_POST["raza"];
            $filters[] = $raza;
            $param.="s";
            $sql.=" AND post_buscar.raza=? ";
        }
        if(isset($_POST["fecha"]) && $_POST["fecha"]!="") {
            $fecha = $_POST["fecha"];
            $filters[] = $fecha;
            $param.="s";
            $sql.=" AND post_buscar.fecha > ? ORDER BY post_buscar.fecha asc";
        }
        else $sql.=" ORDER BY post_buscar.fecha desc";

        $stmt = $connection->prepare($sql);
        if ($filters) {
            $stmt->bind_param($param, ...$filters);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
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