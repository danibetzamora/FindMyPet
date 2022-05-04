<?php
include "config.php";
session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");
#$idUsuario = $_SESSION["user"]["id"];
$idUsuario = 5;
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']))
    {
      //Mostrar un post
      $id=$_GET['id'];
      $sql = $connection->prepare("SELECT * FROM post_encontrado where id='$id'");
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->get_result()->fetch_assoc()  );

      exit();
	  }
    else {
      //Mostrar lista de post
      $sql = $connection->prepare("SELECT * FROM post_encontrado");
      $sql->execute();
      $sql = $sql->get_result();
      header("HTTP/1.1 200 OK");
      while( $row =$sql->fetch_assoc()){
        echo json_encode( $row);
       
      }
      exit();
	}
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    $datos = json_decode(file_get_contents('php://input'));
    echo (datos->raza);
    $input = $_POST;
    $fecha = $_POST['fecha'];
    $fechaGenerada= date('Y-m-d H:i:s'); 
    $separarFecha= explode(" ",$fechaGenerada);
    $horaSep = " " . $separarFecha[1];
    $fecha = $fecha . $horaSep;
    $adress = 'imagenes/postEncontrado/';
    $upload = $adress.basename($_FILES['fotos']['name']);
    $sql =$connection->prepare("INSERT INTO post_encontrado(id,animal,raza,sexo,fecha,ubicacion,descripcion,usuario) VALUES (null,'$_POST[$animal]','$_POST[$raza]','$_POST[$sexo]','$fecha','$_POST[$direccion]','$_POST[$descripcion]','$idUsuario')"); 
    $sql->execute();
    $qid ="SELECT id FROM post_encontrado WHERE usuario='$idUsuario' and fecha ='$fecha'";
    $r = mysqli_query ($connection, $qid) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
    $idPost=$r->fetch_assoc();
    $idPost =$idPost["id"];

    if (move_uploaded_file($_FILES['fotos']['tmp_name'], $upload)) {
        $pathPhoto = $adress . $_FILES['fotos']['name'] ;
        $query = $connection->query("INSERT INTO foto_post_encontrado VALUES (null ,$idPost,'$pathPhoto') ");
        
    } 
    
    $postId = $connection->lastInsertId();
    if($postId)
    {
      $input['id'] = $postId;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
	 }
}

?>