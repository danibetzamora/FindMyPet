<?php
include('api/config.php');
$_SESSION = array();
session_start();
session_destroy(); 
setcookie (session_name(), '', time()-3600); 
header('Location: '.'homeInvitado.php');
?>