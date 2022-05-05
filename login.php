<?php

include 'api/usuarios.php';
global $error;
$error = false;

if(isset($_POST['Login'])){
    $email = $_POST['fcorreo'];
    $password = SHA1($_POST['fpass']);

    $result = verifyPassword($email, $password);
    if (mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_array($result);
        session_start();
        $_SESSION["user"] = $user;
        if ($user["rol"]==1)header('Location:homeUsuarioWeb.php');
        else header('Location:administrador/homeAdmin.php');
    }else{
        $error = true;
    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
</head>
<body style="overflow:hidden;height: 100%;width: 100%;margin: 0%;padding: 0%;">
<div id="main-container" style="height: 100%; width: 100%; display: flex; margin: 0; padding: 0;">
    <div id="half-left" style="width: 50%; min-height: 100vh;background-color: #FCDA68;display: flex;justify-content: center;flex-direction: column;">
        <div id="logo-div" style="height: 50%;">
            <div style = "position:fixed;top:20vh;left:-3vw;width:10vw;height:10vh;transform: rotate(120deg);"><img  style = "width:50%" src ="imagenes/huella.png"></div>
            <div style = "position:fixed;top:50vh;right:55vw;width:10vw;height:10vh;transform: rotate(60deg);"><img  style = "width:50%" src ="imagenes/huella.png"></div>
            <div style = "position:fixed;top:92vh;right:92vw;width:10vw;height:10vh;"><img  style = "width:50%" src ="imagenes/huella.png"></div>
            <div style = "position:fixed;top:-4vh;right:45.2vw;width:10vw;height:10vh;transform: rotate(-30deg);"><img  style = "width:50%" src ="imagenes/huella.png"></div>

            <div style="width: 100% ;height:50%;display: flex;justify-content: center;"><img style="max-width:50%" src="imagenes/FindMyPet.svg"></div>

            <div style="width: 60%;margin:auto;"><h3 style="font-family:'Inter';color: #ffffff;text-align: center;font-size:1.5vw;font-weight:600">Ayuda a nuestros mas fieles compañeros a estar de vuelta con sus adorados dueños</h3></div>

        </div>
        <div style="width: 100% ;height:50%;display: flex;justify-content: center;margin-bottom: 0px;"><img style="max-width:80%" src="imagenes/perrosPortada.svg"></div>
    </div>
    <div id="half-right" style="background-color: #ffffff;width: 50%;  min-height: 100vh;  " >
        <div style="text-align: center; height: 15vh">
            <h3 id="text-login-form" style="font-family:Inter;font-weight:700;font-size: 2vw;color: #2D2B40;margin-top:6vh"">
                Bienvenido de nuevo
            </h3>
            <p style="font-family: Inter;font-weight:500;font-size: 1.2vw;color: #2D2B40">Acceda a la plataforma preferida de perros y gatos.</p>
        </div>
        <div id="form-login" style = "margin-top:20%;height:40vh;width:100%;display:flex;font-family:'Inter';font-size: 0.8vw;align-content:center;">
            <form method="post" style="margin: auto;margin-top: -6vh" action="">
                <div id="error-login"><?php if ($error){echo '<p style="color: red; text-align: center"> Usuario o contraseña no son correctos.</p>';} ?></div>
                <label for="fcorreo">Correo electrónico</label><br>
                <input required minlength="8" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" autocomplete="new-text" style = "font-size:0.7vw;font-family:'Inter';margin-top:0.5vh;margin-bottom: 2vh;border:none;border-radius:6px;background-color:#EFEFEF;width: 40vw;padding:0.6vw;outline:none;" type="text" id="fcorreo" name="fcorreo" placeholder="Introduzca su correo"><br>
                <label for="fpass">Contraseña</label><br>
                <input pattern ="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required minlength="8"  required autocomplete="new-password" style = "font-size:0.7vw;font-family:'Inter';margin-top:0.5vh;margin-bottom: 2vh;border:none;border-radius:6px;background-color:#EFEFEF;width: 40vw;padding:0.6vw;outline:none;" type="password" id="fpass" name="fpass" placeholder="Incluya una mayuscula y un número"><br>
                <div style="text-align: center;margin-top :15%">
                    <button style = "cursor:pointer;margin-bottom: 2vh;border:none;border-radius:15px;width: 20vw;background-color: #FCDA68;padding: 0.4vw;color: #ffffff;font-family: 'Inter';font-size: 0.90vw;" name="Login" type="submit" value="Login">Iniciar sesión</button><br>
                    <a href="registro.php"> <button style = "cursor:pointer;margin-bottom: 2vh;border:solid 0.1vw;border-radius:15px;border-color:#FCDA68;width: 20vw;background-color: #ffffff;padding: 0.4vw;color: #2D2B40;font-family: 'Inter';font-size: 0.80vw;" name="Register" type="button" value="Registrarse">Registrarme</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>