<?php

function check_up($username, $password) {

	$query = "SELECT * FROM wa_users WHERE username = '$username' and pass = '$password'";
	$result = pg_query($conn, $query);
	echo $result;
	if($ok = pg_fetch_array($result)) {
		echo 'login gone well';
		return true;

	}
	echo 'login gone wrong';
	return false;
}

function has_cookies() {

	if(isset($_COOKIE['username']) and isset($_COOKIE['password'])) {
		
		return true;
	}

	return false;

}



?>