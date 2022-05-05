<?php
    if(!isset($_SESSION['user'])) header("Location: homeInvitado.php");

    function getListChat(){
        include ('config.php');
        $user = $_SESSION['user'];

        //$query = "SELECT * FROM `chat` WHERE `usuario_uno` = '$user[0]';";
        $query_users_chat = "SELECT * FROM usuario JOIN chat ON usuario_uno = '$user[0]' OR usuario_dos = '$user[0]'
                            WHERE (usuario.id = chat.usuario_dos OR usuario.id = chat.usuario_uno) AND usuario.id != '$user[0]';";

        $users = $connection->query($query_users_chat);

        return $users;
    }

    function sendMessage($msg, $sql_chat){
        include ('config.php');

        $ejecutar = $connection->query($sql_chat);
        $user = $_SESSION['user'];
        while ($row = $ejecutar -> fetch_array()){
            $id_chat = $row['id'];
        }
        $date = date('Y-m-d h:i:s', time());
        $sql = "INSERT INTO mensaje (date, texto, emisor, chat) VALUES ('$date', '$msg',
                                                        '$user[0]', '$_GET[id]')";

        $ejecutar = $connection->query($sql);

        return $ejecutar;

    }

    function getChat($id){
        include ('config.php');
        $_SESSION['chat_id'] = $id;
        $user = $_SESSION['user'];
        $sql_get_chat = "SELECT id FROM chat WHERE usuario_uno = '$user[0]' AND usuario_dos = ".$id;

        return $sql_get_chat;
    }

    function getMessages(){
        include ('config.php');

        $user = $_SESSION['user'];

        $sql = "SELECT * FROM mensaje JOIN chat ON (chat.usuario_uno = ".$user[0]." OR chat.usuario_dos = ".$user[0].") WHERE mensaje.chat = chat.id ORDER BY mensaje.date ASC;";

        $ejecutar = $connection -> query($sql);

        return $ejecutar;
    }
