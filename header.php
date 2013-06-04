<?php
include_once('config.php');
include_once('functions.php');
 ?>
<!DOCTYPE HTML>
<html>
<body>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<div id="mainwrap">
<div id="wrap">

<div id="header">
<a id="logo" href="/"></a> <!-- Main logo -->
<div id="menu">
    	<ul>
	<li><a href="/">Home</a></li>
	<?php
	if(!has_cookies()) {
	?>
	<li><a href="register.php">Register</a></li>
	<?php } else { ?>
	<li><a href="changepass.php">Change Password</a></li>
	<?php } ?>
	</ul>
</div>
 <div id="user">
 <div id="avatar"></div>
<?php
if(has_cookies()) {
	?>
<a href="logout.php">Logout</a>
	<?php
} else {
?>
<a href="login.php">Log in</a>
<?php
}
?>
</div> <!-- user div -->
</div> <!-- header div -->
<hr />
<div id="content">

<?php
?>
