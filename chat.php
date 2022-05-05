<?php
    session_start();
    include_once "api/usuario.php";
    include_once "api/chat.php";
    global $error;
    $view_chat = false;
    if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");

    $error = false;
    $user = $_SESSION["user"];

    $fotoUsuario = getFotoUsuario($user['id']);

    if(isset($_GET['id'])){
        $view_chat = true;
        $sql_get_chat = getChat($_GET['id']);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/chat.css">
    <link rel="stylesheet" href="componentes/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        function ajax(){
            var req = new XMLHttpRequest();

            req.onreadystatechange = function (){
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }

            req.open('GET', 'chatLoad.php', true);
            req.send();
        }

        setInterval(function (){ajax();}, 1000);
    </script>
</head>
<body onLoad="ajax();">

    <header>
        <nav>
            <a href="homeUsuarioWeb.php">Encontrados</a>
            <a href="buscados.php">Buscados</a>
            <a href="formPostEncontrado.php">Encontré</a>
            <a href="formPostBuscado.php">Estoy Buscando</a>
            <a href="chat.php">Chats</a>
        </nav>

        <div class="user-image">
            <img onclick="menu();" src=<?php echo $fotoUsuario ?> alt="User profile image">
            <div id = "menud" class="menu">
                <a href="perfilUsuario.php">Perfil</a>
                <a href="">Mis Posts</a>
                <a href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </header>
    <div class="main-container">
    
        <div class="container-users">
            <?php
                $users = getListChat();
                if ($users->num_rows > 0) {
                    while ($row = $users->fetch_assoc()) {
                        echo '<a href="chat.php?id='.$row['id'].'">
                                    <div class="details">
                                        <p>'.$row['nombre']." ". $row['apellidos'].'</p>
                                    </div>
                            </a>';
                    }
                }
            ?>
        </div>
                
        <div id="container-chat">
            <div id="caja-chat">
                <div id="chat">

                </div>
            </div>
            <!-- action="chat.php" -->
            <?php
                if(isset($_GET['id'])){
            ?>
                <div class="caja-enviar-mensaje">
                    <form method="post" >
                        <input autocomplete="off"  type="text" name="mensaje", placeholder="Escribe el mensaje..." class="input-text"></textarea>
                        <input type="submit", name="enviar", value="Enviar" class="button-send">
                    </form>
                </div>
            <?php
                }else{
                    $_SESSION['chat_id'] = null;
                }
            ?>

            <?php
                if (isset($_POST['enviar'])){
                    $msg = $_POST['mensaje'];
                    $ejecutar = sendMessage($msg, $sql_get_chat);
                    if($ejecutar){
                        header("location: chat.php?id=".$_GET['id']);
                    }
                }
            ?>
        </div>

    </div>

</body>
</html>

<script>
    var slider = document.getElementById("slidebar");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value;

    slider.oninput = function() {
        output.innerHTML = this.value;
    }

    function menu (){
        if (document.getElementById("menud").style.display==="flex"){
            document.getElementById("menud").style.display="none";
        }else {
            document.getElementById("menud").style.display="flex";
        }
    }

</script>