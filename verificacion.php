<?php
    include "api/usuario.php";

    if(isset($_GET["verificacion"]) && isset($_GET["id"])){
        verifyAccount($_GET['id'], $_GET['verificacion']);
        echo "Verificado!";
    }
    else echo "Intentelo de nuevo<br>";

?>