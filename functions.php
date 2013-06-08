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

function addblankPNG($path, $npages) {

	$img = imagecreatetruecolor(540, 460);
	imagesavealpha($img, true);

	$color = imagecolorallocatealpha($img,0x00,0x00,0x00,127); 
	imagefill($img, 0, 0, $color); 

	imagepng($img, $path . $npages . '.png');

	imagedestroy($img);
}

function create_physical_board($path) {

	#echo '<br />'.$path.'<br />';
	if(!mkdir($path, 0777, true))
		return false;

	$img = imagecreatetruecolor(540, 460);
	imagesavealpha($img, true); 

	$color = imagecolorallocatealpha($img,0x00,0x00,0x00,127); 
	imagefill($img, 0, 0, $color); 

	imagepng($img, $path . '0.png');

	imagedestroy($img);
	return true;
}


function run_db_query($query) {

	echo $query;
	echo $conn;
	return pg_query($conn, $query) or die('Database error');
}

function get_field($query, $field) {

	$result = run_db_query($query);
	$row = pg_fetch_array($result);

	return $row[$field];
}

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}



?>
