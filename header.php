<?php
include_once('config.php');
include_once('functions.php');
 ?>
<ul>
<li><a href="/">Home</a></li>
<?php
if(has_cookies()) {
	?>
<li><a href="logout.php">Logout</a></li>
	<?php
} else {
?>
<li><a href="login.php">Log in</a></li>
<?php
}
?>
</ul>
<?php
?>
