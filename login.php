<?php include_once('header.php');
if(isset( $_POST['submitted'] ) ) {
	echo 'Yeey.. Something works';
} else {
?>
<h1>Login</h1>
<form action="login.php" method="post">
<p>User name: <input type="text" name="username" size="20" maxlength="80" /> </p>
<p>Password: <input type="password" name="password" size="20" maxlength="20" /> </p>
<p><input type="submit" name="submit" value="Login" /></p>
<input type="hidden" name="submitted" value="1" />
</form>
<?php
}
?>
