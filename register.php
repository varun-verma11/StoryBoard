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
	pg_query($conn, $query) or die('Unable to add user to database');
	echo 'Registration succesful!';

}
	
} else {
?>
<!--
<div class="tab-pane fade" id="create">
					<form id="tab">
						<label>Username</label>
						<input type="text" value="" class="input-xlarge">
						<label>First Name</label>
						<input type="text" value="" class="input-xlarge">
						<label>Last Name</label>
						<input type="text" value="" class="input-xlarge">
						<label>Email</label>
						<input type="text" value="" class="input-xlarge">
						<label>Address</label>
						<textarea value="Smith" rows="3" class="input-xlarge">
						</textarea>
						
						<div>
							<button class="btn btn-primary">Create Account</button>
						</div>
</form></div> -->

<h1>Register</h1>
<form class="form-horizontal" action="register.php" method="post">
<div class="control-group">
<label class="control-label" for="Username">User Name</label>
<div class="controls">
<input type="text" id="Username" name="username" placeholder="User Name">
</div>
</div>

<div class="control-group">
<label class="control-label" for="Email">E-mail Address</label>
<div class="controls">
<input type="text" id="Username" name="email" placeholder="Email">
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Password</label>
<div class="controls">
<input type="password" id="inputPassword" name="password" placeholder="Password">
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword2">Re-enter password</label>
<div class="controls">
<input type="password" id="inputPassword2" name="password_verify" placeholder="Password">
</div>
</div>

<!--<p>User name: <input class="input" type="text" name="username" size="20" maxlength="80" /> </p>
<p>Password: <input class="input" type="password" name="password" size="20" maxlength="20" /> </p> -->
<p><input type="submit" class="button" name="submit" value="Login" /></p>
<input type="hidden" name="submitted" value="1" />
</form>
<!--
<h1>Register</h1>
<form action="register.php" method="post">
<p>User name: <input type="text" name="username" size="20" maxlength="80" /> </p>
<p>E-mail address: <input type="text" name="email" size="20" maxlength="80" /> </p>
<p>Password: <input type="password" name="password" size="20" maxlength="20" /> </p>
<p>Re-enter password: <input type="password" name="password_verify" size="20" maxlength="20" /> </p>
<input type="hidden" name="submitted" value="1" />
<p><input type="submit" name="submit" value="register" class="button" /></p>
</form>
-->

<?php
}
include_once('footer.php');
?>
