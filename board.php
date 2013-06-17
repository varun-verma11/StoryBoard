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

		echo '<div align=\'center\'>';
		if(!pg_fetch_array($result)) 
			#Error page again!
			error_page();

		echo '<h2 id=\'btitle\'>' . $name . '</h2>';
		echo '<b>';
		echo '(' . $npages;
		if($npages == 1)
			echo ' Page)';
		else
			echo ' Pages)';
		echo  '</b><br />';
		storyboard($name, $npages);

		echo '<script> function open_editor()'
			. '{'
				. ' alert("start open");'
				. ' var lastImage = document.getElementById("lastImage");' 
				. ' if (lastImage.className == "storyboard")'
				. ' {'
					. '	lastImage.className = "storyboard fancybox.iframe";'
					. ' lastImage.href = "./paint.php?b='. $name . '&f=' . $npages . '";'
				. '} else '
				. '{'
					. 'lastImage.className = "storyboard";'
					. 'lastImage.href = "./storyboard/'. $name . '/' . $npages. '.png";'
				.'}'
				. ' alert("end open");'
			. '}; </script>' ;


		echo '<script> function close_editor()'
			. '{'
				. ' alert("start close");'
				// . ' document.getElementById("openEditor");'
				. ' document.getElementById("lastImage").className = "storyboard";'
				. ' document.getElementById("lastImage").href = "./storyboard/' . $name . '/' . $npages . '.png";'
				. ' alert("end close");'
				. ' document.getElementById("lastImage").onclick = open_editor();'
			. '}; </script>' ;

		if(has_cookies()) {
		
	

		echo '<div id="adminsection">';
		echo '<input type=\'button\' value=\'Add new page\' onclick="add_page()" />';
		echo '<input type=\'button\' value=\'Delete last page\' onclick="delete_page()" />';
		#echo '<a href=\'board.php?name=' . $name . '&addpage=true\'>Add Page</a><br />';
		#echo '<a href=\'board.php?name=' . $name . '&delete=true\'>Delete</a>';
		echo '</div>';
		}
		
		echo '<div id=\'description\'>';
		echo $desc;
		echo '</div>';


		echo '</div>';
		



?>

<?php include_once('footer.php'); ?>