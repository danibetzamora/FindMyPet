<?php

include 'api/usuario.php';
global $error;
$error = 0;

if(isset($_POST['Login'])){
    $email = $_POST['fcorreo'];
    $password = SHA1($_POST['fpass']);

    $result = verifyPassword($email, $password);
    if (mysqli_num_rows($result) > 0){
        $authResult = verifyAuth($email);
        if($authResult==1){
            $user = mysqli_fetch_array($result);
            session_start();
            $_SESSION["user"] = $user;
            if ($user["rol"]==1)header('Location:homeUsuarioWeb.php');
            else header('Location:administrador/homeAdmin.php');
        } else $error = 2;
    }else $error = 1;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/login.css">
</head>
<body>
    <div id="main-container" >
        <div id ="principal" >
            <div id = "titulo">
                <div  id="contenedor-foto-titulo"><img src="imagenes/FindMyPet.svg"></div>
                <div id="contenedor-texto-titulo"><h3 >Ayuda a nuestros más fieles compañeros a estar de vuelta con sus adorados dueños</h3></div>
            </div>

            <div id="contenedor-foto"><img  id ="foto-animales" src="imagenes/perrosPortada.svg"></div>
        </div>

        <div id="formulario">
            <div id="cabecera-formulario">
                <h3 id="cabecera-titulo">Bienvenido de nuevo</h3>

                <p>Acceda a la plataforma preferida de perros y gatos.</p>
            </div>

            <div id="form">
                <form method="post" action="">
                <div id="error-login"><?php if ($error==1){echo '<p style="color: red; text-align: center"> Usuario o contraseña no son correctos.</p>';}
                                            if ($error==2){echo '<p style="color: red; text-align: center"> Cuenta no activada, compruebe su direccion de correo.</p>';}?></div>
                    <label for="fcorreo">Correo electrónico</label><br>
                    <input required minlength="8" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" autocomplete="new-text" type="text" id="fcorreo" name="fcorreo" placeholder="Introduzca su correo"><br>
                    <label for="fpass">Contraseña</label><br>
                    <input pattern ="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required minlength="8"  required autocomplete="new-password" type="password" id="fpass" name="fpass" placeholder="Incluya una mayuscula y un número"><br>
                    <div id="buttons">
                        <button id="boton-login" name="Login" type="submit" value="Login">Iniciar sesión</button><br>
                        <a href="registro.php"> <button id="boton-registro" name="Register" type="button" value="Registrarse">Registrarme</button></a>
                    </div>
                </form>
            </div>
        </div>

        <div id="contenedor-foto-footer"><img  id ="foto-animales" src="imagenes/perrosPortada.svg"></div>
    </div>
</body>
</html>