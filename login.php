<?php include_once('header.php');
if(isset( $_POST['submitted'] ) ) {

$errors = array();

if( empty($_POST['username']) )
	$errors[] = "Please enter your username";

if( empty($_POST['password']) ) 
	$errors[] = "Please enter your password";

if(!empty($errors)) {

	echo '<h1>Errors!</h1>';

	echo '<ul>';
	
	foreach($errors as $error) {

		echo '<li>' . $error . '</li>';

	}

	echo '</ul>';

} else {
	$username = $_POST['username'];
	$pass = $_POST['password'];
	$query = "SELECT * FROM wa_users WHERE username = '$username' and pass = '$pass'";
	$result = pg_query($conn, $query);
	if($usertable = pg_fetch_array($result)) {
		echo 'Login succesful';
	} else {
		echo 'Unsuccesful login';
	}
}

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
