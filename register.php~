<?php include_once('header.php');
if (isset($_POST['submitted']) ) {

$errors = array();

//Validating the e-mail:
#$email = $_REQUEST['email'];
if( empty($_POST['email']) )
	$errors[] = "Email address not set";

if( empty($_POST['username']) )
	$errors[] = "Username not set";

if( empty($_POST['password']) ) {

	$errors[] = "Password not set";

} else {

	$pass1 = $_REQUEST['password'];
	$pass2 = $_REQUEST['password_verify'];

	if(strcmp($pass1, $pass2) != 0)
	
		$errors[] = "Passwords not matching";	

}

if(!empty($errors)) {

	echo '<h1>Errors!</h1>';

	echo '<ul>';
	
	foreach($errors as $error) {

		echo '<li>' . $error . '</li>';

	}

	echo '</ul>';

} else {

	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query = "INSERT INTO wa_users(username, email, pass) VALUES ('$username', '$email', '$password');";
	//echo $query; 
	$result = pg_query($conn, $query);
	if(!$result) {
		echo 'Unable to add user to database';
	} else {
		echo 'Registration succesful!';
	}

}
	
} else {
?>
<h1>Register</h1>
<form action="register.php" method="post">
<p>User name: <input type="text" name="username" size="20" maxlength="80" class="input" /> </p>
<p>E-mail address: <input type="text" name="email" size="20" maxlength="80" class="input" /> </p>
<p>Password: <input type="password" name="password" size="20" maxlength="20" class="input" /> </p>
<p>Re-enter password: <input type="password" name="password_verify" size="20" maxlength="20" class="input" /> </p>
<input type="hidden" name="submitted" value="1" />
<p><input type="submit" name="submit" value="register" class="button" /></p>
</form>


<?php
}
include_once('footer.php');
?>
