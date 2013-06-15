<?php 
include_once('header.php');
?>
<?php

	$page = 1;
	$boards_per_pages = 10;

	if(isset($_GET['p'])) {
		$page = $_GET['p'];
	}

	$query = 'SELECT * FROM wa_storyboards ORDER BY creation_date LIMIT ' 
	. ($page * $boards_per_pages) 
	. ' OFFSET ' . (($page-1) * $boards_per_pages);
	#echo $query;

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



<?php
include_once('footer.php');
?>
