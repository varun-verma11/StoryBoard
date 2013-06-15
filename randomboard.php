<?php include('config.php'); ?>

<?php

	$board_query = 'SELECT name FROM wa_storyboards ORDER BY RANDOM() LIMIT 1';

	$result = pg_query($conn, $board_query) or die('Database Error!');

	$row = pg_fetch_array($result);
	$name = $row[0];
	echo $name;
	$href = '/board.php?name=' . $name;

	header( 'Location: ' . $href ) ;
?>
