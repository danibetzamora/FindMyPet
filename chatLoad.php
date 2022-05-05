<?php
    session_start();
    include_once "api/chat.php";
    if (isset($_SESSION['chat_id'], $_SESSION['user'])){

        $ejecutar = getMessages();

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