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

function storyboard($name,$npages)
{
	#heading($name);
	html_break();
	paragraph(generate_slideshow($name, $npages));
}

function heading($name)
{
	echo '<h3>' . $name . '</h3>';
}

function paragraph($text)
{
	echo '<p>' . $text . '</p>';
}

function html_break()
{
	echo '<br>';
}

function generate_slideshow($name, $npages)
{	if ($npages !=0) { echo cover_pic($name); }
	else {
		echo only_cover_pic($name);
	}

	if ($npages>0)
	{
		echo all_pics($name, $npages);		
	}
}


function only_cover_pic($name)
{
	echo '<a id="lastImage" class="storyboard" data-fancybox-group="' 
		. $name 
		. '" href="./storyboard/' 
		. $name . '/0.png" title="Edit this image! <a id=\'openEditor\' '
		. ' href=\'javascript:open_editor();\'' 
		. ' style=\'color: #CC0000\' target=\'_parent\' >Launch editor</a>" >'
		.  '<img width="300" border="1" class="img-polaroid" height="200"'. ' src="./storyboard/'
		. $name
		. '/0.png" alt ="1" /> </a>'
		. ' ' ;
}


function cover_pic($name)
{
	echo '<a class="storyboard" border="1" data-fancybox-group="' 
		. $name 
		. '" href="./storyboard/' 
		. $name 
		. '/0.png"> <img class="img-polaroid" border="1" width="300" height="200"'. ' src="./storyboard/'
		. $name
		. '/0.png" alt ="1" /> </a>'
		. ' ' ;
}

function get_number_of_images($name)
{
	return 10;
}

function all_pics($name, $num_images)
{
	for ($i=1; $i<$num_images; $i++)
	{
		//echo strval($i);
		echo_img_for_slideshow($name, $i); //last img not shown
	}
	echo_last_img_for_slideshow($name, $i);
	// echo_adding($name, $i); //get last image and storyboard name
}

function echo_adding($name, $number)
{//" title="test title"

	// echo '<a class="storyboard fancybox.iframe" data-fancybox-group="'
	// 	. $name
	// 	. '" href="paint.php?b='
	// 	. 'Board'
	// 	. '&f='
	// 	. '1'
	// 	. '" </a>'
	// 	. ' '; 
	
	echo '<a class="storyboard fancybox.iframe" data-fancybox-group="'
		. $name
		. '" href="paint.php?b='
		. $name
		. '&f='
		. ($number)
		. '" > </a>'
		. ' '; 
		
}


function echo_img_for_slideshow($name, $number)
{//get title/caption using name and number from database
	//for now
	// echo '<a class="storyboard" data-fancybox-group="'
	// 	. $name
	// 	. '" title="Edit this image! <a href=\'../Paint/paint_app.php?b=Board&f=1\'>Launch editor</a>" href="./'
	// 	. $name 
	// 	. '/'
	// 	. strval($number)
	// 	. '.png" </a>'
	// 	. ' ';

	echo '<a class="storyboard" data-fancybox-group="'
		. $name
		. '" href="./storyboard/'
		. $name 
		. '/'
		. strval($number)
		. '.png"> </a>'
		. ' ';

}

function echo_last_img_for_slideshow($name, $number)
{//get title/caption using name and number from database
	//for now
	// echo '<a class="storyboard" data-fancybox-group="'
	// 	. $name
	// 	. '" title="Edit this image! <a href=\'../Paint/paint_app.php?b=Board&f=1\'>Launch editor</a>" href="./'
	// 	. $name 
	// 	. '/'
	// 	. strval($number)
	// 	. '.png" </a>'
	// 	. ' ';

	echo '<a class="storyboard" id="lastImage" data-fancybox-group="'
		. $name
		. '" title="Edit this image! <a id=\'openEditor\' '
		. ' href=\'javascript:open_editor();\'' 
		. ' style=\'color: #CC0000\' target=\'_parent\' >Launch editor</a>" href="./storyboard/'
		. $name 
		. '/'
		. strval($number)
		. '.png"> </a>';
}

function error_page() 
{

	header('Location: error.php');
}

?>
