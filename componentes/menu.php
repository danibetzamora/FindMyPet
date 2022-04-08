<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="componentes/header.css">
    <title>Document</title>
</head>
<style>
    
.menu{
    width: 120px;
    height: 170px;
    background-color: #EFEFEF;
    border-radius: 10px;
    display:flex ;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    font-family: 'Inter';
    display:none;
    position:absolute;
}
.menu a{
    margin: auto;
}
.user-image{
    width:120px;
    display:flex;
    flex-direction:column;
    
}

</style>
<header>
    <nav>
        <a href="">Buscar</a>
        <a href="">Se Busca</a>
        <a href="formPostEncontrado.php">Encontre</a>
        <a href="">Estoy Buscando</a>
        <a href="">Chats</a>
    </nav>

    <div class="user-image">
        <img onclick="menu();"src= "imagenes/fotoPerfil.png" alt="User profile image">
        <div id = "menud" class="menu">
            <a href="">Perfil</a>
            <a href="">Mis Posts</a>
            <a href="">Cerrar Sesión</a>
        </div>
    </div>
</header>
<body>
    
</body>
</html>
<script>
    function menu (){
        if (document.getElementById("menud").style.display==="flex"){
            document.getElementById("menud").style.display="none";
        }else {
            document.getElementById("menud").style.display="flex";
        }
    }
</script>