<?php

$_SESSION = array();
session_start();
unset($_SESSION['user']);
session_destroy();
setcookie (session_name(), '', time()-3600); 
header('Location: '.'homeInvitado.php');
?>