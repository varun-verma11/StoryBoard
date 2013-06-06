<?php
$host = "localhost"; 
$user = "postgres"; 
$pass = "password"; 
$db = "mydb"; 

$conn = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n"); 

 
?>
