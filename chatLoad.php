<?php
    include_once "config.php";
    session_start();
    if (isset($_SESSION['chat_id'])){
        $user = $_SESSION['user'];

        /*$sql = "SELECT * FROM `mensaje` JOIN chat ON chat.usuario_uno ='$user[0]' and
                                  chat.usuario_dos = ".$_GET['id']." WHERE mensaje.chat = chat.id
                                  ORDER BY mensaje.date DESC;";*/

        /*$sql = "SELECT * FROM `mensaje` JOIN chat ON chat.usuario_uno = '$user[0]' OR
                                     chat.usuario_dos = '$user[0]' WHERE chat.id = mensaje.chat;";*/

        /*$sql = "SELECT * FROM mensaje JOIN chat ON
            (chat.usuario_uno = ".$user[0]." OR chat.usuario_dos = ".$user[0].") AND 
            (chat.usuario_uno = ".$_SESSION['user_dos']." OR chat.usuario_dos = ".$_SESSION['user_dos'].") WHERE mensaje.chat = chat.id;";*/

        $sql = "SELECT * FROM mensaje JOIN chat ON (chat.usuario_uno = ".$user[0]." OR chat.usuario_dos = ".$user[0].") WHERE mensaje.chat = chat.id;";

        $ejecutar = $connection -> query($sql);

        while ($row = $ejecutar -> fetch_array()):
            if($row['chat'] == $_SESSION['chat_id']){
        ?>
                <div id="datos-chat">
                    <span><?php echo $row['texto']; ?></span>
                    <span><?php echo $row['date']; ?></span>
                </div>
        <?php
            }
            endwhile;
    }
?>