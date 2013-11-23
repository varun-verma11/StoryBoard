<?php
include_once('header.php');

?>
<?php
if(isset( $_POST['submitted'] ) ) {
	$errors = array();
	if( empty($_POST['password']) )
		$errors[] = "Please enter your password";
	if( empty($_POST['pass1']) )
		$errors[] = "Please enter your new password";

	$pass1 = $_REQUEST['pass1'];
	$pass2 = $_REQUEST['pass2'];
	if(strcmp($pass1, $pass2) != 0) {
	
		$errors[] = "Passwords not matching";
		
	}
/*$query = 'SELECT pass FROM wa_users WHERE username = \'' . $_COOKIE['username'] . '\'';
echo $query;*/
//$result = pg_query($conn, $query);
/*if($row = pg_fetch_array($result)) {
	$p1 = $row['pass'];
	$p2 = $_POST['password'];
	echo '<br />'.$p1.'<br />'.$p2;
	if(strcmp($p1, $p2) != 0)
	$errors[] = "Incorrect password";
}*/
$query = 'UPDATE wa_users SET pass=\''.$_REQUEST['pass1'].'\' WHERE username = \''.$_COOKIE['username'].'\'';

if(!empty($errors)) {
	
		echo '<h1>Errors!</h1>';

		echo '<ul>';
	
		foreach($errors as $error) {

			echo '<li>' . $error . '</li>';
	
		}

} else {
	pg_query($conn, $query) or die('Database error. Cannot change the password');
#echo $query;
}
} else {
?>
<!--
<form action="changepass.php" method="post">
<p>Current password: <input class="input" type="password" name="password" size="20" maxlength="20" /></p>
<p>New password: <input class="input" type="password" name="pass1" size="20" maxlength="20" /></p>
<p>Retype password: <input class="input" type="password" name="pass2" size="20" maxlength="20" /></p>
<p><input type="submit" class="button" name="submit" value="Reset" /></p>
<input type="hidden" name="submitted" value="1" />
</form>
-->
<form class="form-horizontal" action="changepass.php" method="post">

<div class="control-group">
<label class="control-label" for="inputPassword">Current password</label>
<div class="controls">
<input type="password" id="inputPassword" name="password" placeholder="Current password">
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword2">New password</label>
<div class="controls">
<input type="password" id="inputPassword2" name="pass1" placeholder="New password">
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword3">Retype password</label>
<div class="controls">
<input type="password" id="inputPassword3" name="pass2" placeholder="Retype password">
</div>
</div>
<!--<p>User name: <input class="input" type="text" name="username" size="20" maxlength="80" /> </p>
<p>Password: <input class="input" type="password" name="password" size="20" maxlength="20" /> </p> -->

<div class="control-group">
<div class="controls">
<input type="submit" class="btn" name="submit" value="Reset" />
</div>
</div>
<input type="hidden" name="submitted" value="1" />
</form>

<?php
}
include_once('footer.php');

?>
