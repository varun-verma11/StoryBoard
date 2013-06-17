<?php include_once('header.php'); 

	$name = $_GET['name'];
	$query = 'SELECT pages, description FROM wa_storyboards WHERE name=\'' . $name . '\'';
	$result = pg_query($conn, $query) or die('Database error');
	$row = pg_fetch_array($result);
	$npages = $row[0];
	$desc = $row[1];
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
		error_page();

		$query = 'SELECT * FROM wa_storyboards WHERE name=\'' . $name . '\'';
		$result = pg_query($conn, $query) or die('Database error');

		echo $npages . '<br />';
		echo '<div align=\'center\'>';
		if(!pg_fetch_array($result)) 
			#Error page again!
			error_page();

		echo '<h2 id=\'btitle\'>' . $name . '</h2>';
		
		storyboard($name, $npages);

		echo '<div id=\'description\'>';
		echo $desc;
		echo '</div>';


		echo '</div>';
		if(has_cookies()) {
		?>
		<div id="adminsection">
			<b>Tools</b>:
		<?php
		echo '<input type=\'button\' value=\'Add new page\' />';
		echo '<input type=\'button\' value=\'Delete last page\' />';
		echo '<a href=\'board.php?name=' . $name . '&addpage=true\'>Add Page</a><br />';
		echo '<a href=\'board.php?name=' . $name . '&delete=true\'>Delete</a>';

		?>
		</div>
		<?php
	}


?>

<?php include_once('footer.php'); ?>