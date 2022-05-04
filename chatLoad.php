<?php
    include_once "config.php";
    session_start();
    if (isset($_SESSION['chat_id'], $_SESSION['user'])){
        $user = $_SESSION['user'];

        /*$sql = "SELECT * FROM `mensaje` JOIN chat ON chat.usuario_uno ='$user[0]' and
                                  chat.usuario_dos = ".$_GET['id']." WHERE mensaje.chat = chat.id
                                  ORDER BY mensaje.date DESC;";*/

        /*$sql = "SELECT * FROM `mensaje` JOIN chat ON chat.usuario_uno = '$user[0]' OR
                                     chat.usuario_dos = '$user[0]' WHERE chat.id = mensaje.chat;";*/

        /*$sql = "SELECT * FROM mensaje JOIN chat ON
            (chat.usuario_uno = ".$user[0]." OR chat.usuario_dos = ".$user[0].") AND 
            (chat.usuario_uno = ".$_SESSION['user_dos']." OR chat.usuario_dos = ".$_SESSION['user_dos'].") WHERE mensaje.chat = chat.id;";*/

        $sql = "SELECT * FROM mensaje JOIN chat ON (chat.usuario_uno = ".$user[0]." OR chat.usuario_dos = ".$user[0].") WHERE mensaje.chat = chat.id ORDER BY mensaje.date ASC;";

        $ejecutar = $connection -> query($sql);

        while ($row = $ejecutar -> fetch_array()):
            if($row['chat'] == $_SESSION['chat_id']){
                if($row['emisor'] == $_SESSION['user']['id']){?>
                    <div id="datos-chat" style="display:flex; justify-content:flex-end; width:98%; height:10%; gap:2rem; align-items: center;">
                        <span style="background-color:#AEF67D; height:50%; display:flex; align-items: center; font-weight: bold; padding: 0.3em; border: 2px solid #EFEFEF; border-radius: 8px;"><?php echo $row['texto']; ?></span>
                        <span style="height:50%; display:flex; align-items: center; font-size: small;"><?php echo $row['date']; ?></span>
                    </div>
                <?php }else{ ?>
                    <div id="datos-chat" style="display:flex; justify-content:flex-start; width:95%; height:10%; gap:2rem; align-items: center; margin-left: 1em;">
                        <span style="background-color:#FFFFFF; height:50%; display:flex; align-items: center; font-weight: bold; padding: 0.3em; border: 2px solid #EFEFEF; border-radius: 8px;"><?php echo $row['texto']; ?></span>
                        <span style="height:50%; display:flex; align-items: center; font-size: small;"><?php echo $row['date']; ?></span>
                    </div>
            <?php } ?>
        <?php
            }
            endwhile;
    }
?>