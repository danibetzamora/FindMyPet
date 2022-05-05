<?php
    if(!isset($_SESSION['user'])) header("Location: homeInvitado.php");

    function getListChat(){
        include ('config.php');
        $user = $_SESSION['user'];

        $sql = "SELECT * FROM usuario JOIN chat ON usuario_uno = ? OR usuario_dos = ?
                            WHERE (usuario.id = chat.usuario_dos OR usuario.id = chat.usuario_uno) 
                            AND usuario.id != ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iii", $user['id'], $user['id'], $user['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function sendMessage($msg, $sql_chat){
        include ('config.php');

        $ejecutar = $connection->query($sql_chat);
        $user = $_SESSION['user'];
        while ($row = $ejecutar -> fetch_array()){
            $id_chat = $row['id'];
        }
        $date = date('Y-m-d h:i:s', time());
        $sql = "INSERT INTO mensaje (date, texto, emisor, chat) VALUES (?, ?,
                                                        ?, ?)";
        $stmt=$connection->prepare($sql);
        $stmt->bind_param("ssii", $date, $msg, $user['id'], $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;

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

        $sql = "SELECT * FROM mensaje 
                JOIN chat ON (chat.usuario_uno = ?
                OR chat.usuario_dos = ?) 
                WHERE mensaje.chat = chat.id 
                ORDER BY mensaje.date ASC";
        $stmt=$connection->prepare($sql);
        $stmt->bind_param("ii", $user['id'], $user['id']);
        $stmt->execute();
        $result=$stmt->get_result();

        return $result;
    }
