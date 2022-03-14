<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Home</title>
    </head>
    <h1>Esto es una prueba</h1>

<?php
 
include('config.php');
$q = "SELECT id FROM usuario"; 
$r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection)); 
echo mysqli_num_rows($r); 

?>
