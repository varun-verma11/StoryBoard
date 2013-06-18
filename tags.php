<?php include_once('header.php'); ?>

<?php

if(!isset($_GET['tag']))
	error_page();

$tag_name = $_GET['tag'];

echo '<h2>Posts tagged under \'' . $tag_name . '\'</h2>';

$query = 'SELECT DISTINCT wa_storyboards.name as name, wa_storyboards.description as description FROM
wa_tags JOIN wa_storyboards
ON wa_tags.bid = wa_storyboards.id
WHERE wa_tags.tag = \'' . $tag_name .'\'';
$result = pg_query($conn, $query) or die('Database error!');


$i = 0;
$left = false;
while($row = pg_fetch_array($result)) {

	$left = $i%2 == 0;
	$name = $row['name'];

	if($left)
		echo '<div class=\'postrow\'>';
	echo '<div class=\'post-';
	if($left) {
		echo 'left';
	} else {
		echo 'right';
	}
	echo '\'>';

	echo '<div class=\'posttitle\'> ';


	echo '<h2><a href=\'board.php?name=' .
		 $name . '\'>' . $name . '</a></h2>';
	echo '</div> '; #Post title close
		echo '<div class=\'postcontent\'>';

		echo '<div class=\'postimage\'>';
		echo '<img src=\'storyboard/' . $name . '/0.png\' />';
		echo '</div>'; #Post image close
		
	echo '<p>' . $row['description'] . '</p>';

	echo '</div>'; #Post content close
			
		
	echo '</div>'; #Post close
	if(!$left)
		echo '</div>';
	echo '<br />';
	$i++;
}
if($left)
	echo '</div>';

 
?>

<?php include_once('footer.php'); ?>