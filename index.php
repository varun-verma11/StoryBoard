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

	while($row = pg_fetch_array($result)) {

		$name = $row['name'];
		echo '<h2><a href=\'board.php?name=' .
			 $name . '\'>' . $name . '</a></h2>';

		echo '<p>' . $row['description'] . '</p>';

		echo '<img src=\'storyboard/' . $name . '/0.png\' />';
	}

?>



<?php
include_once('footer.php');
?>
