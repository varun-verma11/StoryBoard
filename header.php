<?php
include_once('config.php');
include_once('functions.php');
 ?>
<!DOCTYPE HTML>
<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Story Board</title>
<!-- Import these just in board.php TODO -->

	<link href="favicon.ico" rel="icon" type="image/x-icon" />
	<!-- Add jQuery library -->
	<script type="text/javascript" src="./fancybox/lib/jquery-1.9.0.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="./fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="./fancybox/source/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="./fancybox/source/jquery.fancybox.css?v=2.1.4" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="./fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="./fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="./fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="./fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<script type="text/javascript" src="./slideshow.js"></script>
	<script type="text/javascript" src="./scripts.js"></script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
</head>
<body>
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
	<?php } ?>
	<li><a href="#">Top storyboards</a></li>
	<li><a href="randomboard.php">Random storyboard</a></li>
	</ul>
</div>

<?php
	if( has_cookies() ) { ?>
	<div id="usermenu">
		
		<ul>
			<li><b>User Area:</b><br /></li>
			<li>&nbsp;</li>
			<li><a href="changepass.php">Change Password</a></li>
			<li><a href="boards.php">Boards Panel</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<?php
	}
?>

 	<div id="user">
 <!--<div id="avatar"></div>-->
<?php
if(!has_cookies()) {
	?>
<a href="login.php">Log in</a>
<?php
}
?>
	</div> <!-- user div -->
</div> <!-- header div -->
<!-- <hr /> We don't need you anymore -->
<div id="content">

<?php
?>
