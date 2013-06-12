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
	while($row = pg_fetch_array($result)) {

		$name = $row['name'];

		echo '<div class=\'post-';
		if($i%2 == 0) {
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
		echo '<br />';
		$i++;
	}

?>



<?php
include_once('footer.php');
?>
