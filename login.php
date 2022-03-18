<?php
include ('config.php');
global $error;

$error = false;

if(isset($_POST['Login'])){
    $email = $_POST['fcorreo'];
    $password = md5($_POST['fpass']);

    $query = "SELECT * FROM `usuario` WHERE `email` = '$email' AND `contrasena` = '$password';";
    $con = mysqli_query ($connection, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($connection));
    if (mysqli_num_rows($con) > 0){
        $user = mysqli_fetch_array($con);
        session_start();
        $_SESSION["user"] = $user;
        header('Location:homeinvitado.php');
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
</head>
<body style="overflow:hidden;height: 100%;width: 100%;margin: 0%;padding: 0%;">
<div id="main-container" style="height: 100%; width: 100%; display: flex; margin: 0; padding: 0;">
    <div id="half-left" style="min-height: 100vh; width: 50%; background-color: #FCDA68; display: flex; justify-content: center; flex-direction: column;">
        <div id="logo-div" style="height: 50%;">
            <div style="width: 100%; height: 50%; display: flex; justify-content: center">
                <img style="max-width: 50%" src="imagenes/FindMyPet.svg">
            </div>
            <div style="width: 60%; margin: auto;">
                <h3 id="text-login" style="font-family:'Inter';color: #ffffff;text-align: center;">
                    Ayuda a nuestros más fieles compañeros a estar de vuelta con sus adorados
                    dueños.
                </h3>
            </div>
        </div>
        <div style="width: 100% ;height:50%;display: flex;justify-content: center;margin-bottom: 0px;"><img style="max-width:80%" src="imagenes/perrosPortada.svg"></div>
    </div>
    <div id="half-right" style="min-height: 100vh; width: 50%; background-color: #ffffff; display: flex; justify-content: center; flex-direction: column;" >
        <div style="text-align: center">
            <h3 id="text-login-form" style="font-family:Inter;color: #2D2B40">
                Bienvenido de nuevo
            </h3>
            <p style="font-family: Inter;font-weight:500;font-size: 13px;color: #2D2B40">Acceda a la plataforma preferida de perros y gatos.</p>
        </div>
        <div id="form-login" style = "height:80%;display:flex;font-family:Inter;font-size: 13px;">
            <form method="post" style="margin: auto;" action="">
                <div id="error-login"><?php if ($error){echo '<p style="color: red; text-align: center"> Usuario o contraseña no son correctos.</p>';} ?></div>
                <label for="fcorreo">Correo electrónico</label><br>
                <input required minlength="8" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" autocomplete="new-text" style = "font-size: 12px;font-family:'Inter';margin-top:1%;margin-bottom: 4%;border:none;border-radius:2px;background-color:#EFEFEF;width:320px;padding:6px;outline:none;" type="text" id="fcorreo" name="fcorreo" placeholder="Introduzca su correo"><br>
                <label for="fpass">Contraseña</label><br>
                <input pattern ="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required minlength="8"  required autocomplete="new-password" style = "font-size: 12px;font-family:'Inter';margin-top:1%;margin-bottom: 10%;border:none;border-radius:2px;background-color:#EFEFEF;width:320px;padding:6px;outline:none;" type="password" id="fpass" name="fpass" placeholder="Incluya una mayuscula y un número"><br>
                <div style="text-align: center;">
                    <button style = "margin-bottom: 5%;border:none;border-radius:15px;width: 175px;background-color: #FCDA68;padding: 6px;color: #ffffff;font-family: 'Inter';font-size: 14px;" name="Login" type="submit" value="Login">Iniciar sesión</button><br>
                    <a href="login.php"><button style = "margin-bottom: 5%;border:solid 1px;border-radius:15px;border-color:#FCDA68;width: 175px;background-color: #ffffff;padding: 6px;color: #2D2B40;font-family: 'Inter';font-size: 13px;" name="Register" type="submit" value="Registrarse">Registrarme</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>