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
			setcookie('username', $username, time()+60*60*24, '/' );
			setcookie('password', $pass, time()+60*60*24, '/' );
			header( 'Location: /' ) ;
		} else {
			echo 'Unsuccesful login';
		}
	}



} else {
?>
<h1>Login</h1>
<form class="form-horizontal" action="login.php" method="post">
<label class="control-label" for="inputUsername">Username</label>
<div class="controls">
<input type="text" id="inputUsername" name="username" placeholder="Username">
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Password</label>
<div class="controls">
<input type="password" id="inputPassword" name="password" placeholder="Password">
</div>
</div>
<!--<p>User name: <input class="input" type="text" name="username" size="20" maxlength="80" /> </p>
<p>Password: <input class="input" type="password" name="password" size="20" maxlength="20" /> </p> -->
<div class="control-group">
<div class="controls">
<input type="submit" class="btn" name="submit" value="Login" />
</div>
</div>
<input type="hidden" name="submitted" value="1" />
</form>

<?php
}
include_once('footer.php');
?>
