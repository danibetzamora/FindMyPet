<?php
    session_start();
    include_once "api/chat.php";
    if (isset($_SESSION['chat_id'], $_SESSION['user'])){

        $ejecutar = getMessages();

        while ($row = $ejecutar -> fetch_array()):
            if($row['chat'] == $_SESSION['chat_id']){
                if($row['emisor'] == $_SESSION['user']['id']){?>
                    <style>
                        #datos-chat1 {
                            display:flex; 
                            justify-content:flex-end; 
                            width:98%; 
                            min-height:4em; 
                            gap:2rem; 
                            align-items: center;
                            margin-top: 1em;
                        }
                        #message-sent {
                            background-color:#FCDA68; 
                            min-height:50%; 
                            max-width: 50%;
                            display:flex; 
                            align-items: center; 
                            font-weight: bold; 
                            padding: 0.5em; 
                            border: 2px solid #EFEFEF; 
                            border-radius: 8px;
                        }
                        #datos-chat2 {
                            display:flex; 
                            justify-content:flex-start; 
                            width:95%; 
                            min-height:4em; 
                            gap:2rem; 
                            align-items: center;
                            margin-left: 1em;
                            margin-top: 1em;
                        }
                        #message-received {
                            background-color:#FFFFFF; 
                            min-height:50%; 
                            max-width: 50%;
                            display:flex; 
                            align-items: center; 
                            font-weight: bold; 
                            padding: 0.5em; 
                            border: 2px solid #EFEFEF; 
                            border-radius: 8px;
                        }
                        .date {
                            height:50%; 
                            display:flex; 
                            align-items: 
                            center; 
                            font-size: small;
                        }
                        @media (max-width: 700px) {
                            #datos-chat2 {
                                margin-left: 0.4em;
                            }
                            .date {
                                display: none;
                            }
                        }
                    </style>
                    <div id="datos-chat1">
                        <span id="message-sent"><?php echo $row['texto']; ?></span>
                        <span class="date"><?php echo $row['date']; ?></span>
                    </div>
                <?php }else{ ?>
                    <div id="datos-chat2">
                        <span id="message-received"><?php echo $row['texto']; ?></span>
                        <span class="date"><?php echo $row['date']; ?></span>
                    </div>
            <?php } ?>
        <?php
            }
            endwhile;
    }
?>