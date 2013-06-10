<?php
$host = "db.doc.ic.ac.uk"; 
$user = "g1227124_u"; 
$pass = "WfV6cdXbVh"; 
$db = "g1227124_u"; 

$conn = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n"); 

 
?>
