<?php include_once('header.php'); 

	if($_GET['addpage']) {

		$name = $_GET['name'];
		$query = 'SELECT pages FROM wa_storyboards WHERE name=\'' . $name . '\'';
		$result = pg_query($conn, $query) or die('Database error');
		$row = pg_fetch_array($result);
		$npages = $row[0] + 1;
		$path = 'storyboard/' . $name . '/';
		addblankPNG($path, $npages);

		$query = 'UPDATE wa_storyboards SET pages=\'' . $npages . '\' WHERE name=\'' . $name . '\'' ;
		$result = pg_query($conn, $query) or die('Database error');

	} elseif(!isset($_GET['name'])) {
		#Error page?
	} else {

		$name = $_GET['name'];
		$query = 'SELECT * FROM wa_storyboards WHERE name=\'' . $name . '\'';
		$result = pg_query($conn, $query) or die('Database error');


		if(!pg_fetch_array($result)) 
			#Error page again!
			echo 'La';
		 else 
			echo '<a href=\'board.php?name=' . $name . '&addpage=true\'>Add Page</a>';

		


	}


?>

<?php include_once('footer.php'); ?>