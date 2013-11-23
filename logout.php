<?php
#include_once('header.php');

setcookie('username', '', time() - 3600);
setcookie('password', '', time() - 3600);
header( 'Location: /' ) ;

#include_once('footer.php');
?>

