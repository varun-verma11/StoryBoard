<?php include_once('header.php'); 

	$name = $_GET['name'];
	$query = 'SELECT pages FROM wa_storyboards WHERE name=\'' . $name . '\'';
	$result = pg_query($conn, $query) or die('Database error');
	$row = pg_fetch_array($result);
	$npages = $row[0];
	
	if($_GET['delete']) {

		if($npages>0) {

			$npages--;
			$query = 'UPDATE wa_storyboards SET pages=\'' . $npages . '\' WHERE name=\'' . $name . '\'' ;
			pg_query($conn, $query) or die('Database error');
			$npages++;
			unlink('storyboard/'. $name . '/' . $npages . '.png');
			header('Location: /board.php?name='.$name );

		} else {
			echo 'Storyboard empty. Cannot delete any more pages!';
		}

	} elseif($_GET['addpage']) {

		//$name = $_GET['name'];
		//$query = 'SELECT pages FROM wa_storyboards WHERE name=\'' . $name . '\'';
		//$result = pg_query($conn, $query) or die('Database error');
		//$row = pg_fetch_array($result);
		//$npages = $row[0] + 1;
		$path = 'storyboard/' . $name . '/';
		$npages++;
		addblankPNG($path, $npages);
		$query = 'UPDATE wa_storyboards SET pages=\'' . $npages . '\' WHERE name=\'' . $name . '\'' ;
		pg_query($conn, $query) or die('Database error');
		header('Location: /board.php?name=' . $name );

	} elseif(!isset($_GET['name'])) 
		#Error page?
		echo 'Go to hell';
	//} else {

		//$name = $_GET['name'];
		$query = 'SELECT * FROM wa_storyboards WHERE name=\'' . $name . '\'';
		$result = pg_query($conn, $query) or die('Database error');

		echo $npages . '<br />';
		if(!pg_fetch_array($result)) 
			#Error page again!
			echo 'Error!';
		 else {
			echo '<a href=\'board.php?name=' . $name . '&addpage=true\'>Add Page</a><br />';
			echo '<a href=\'board.php?name=' . $name . '&delete=true\'>Delete</a>';
		}
		//echo $npages;
		storyboard($name, $npages);

	//}


?>

<?php include_once('footer.php'); ?>