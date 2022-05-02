<?php
include "config.php";
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


?>