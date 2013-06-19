<?php include_once('header.php'); 

	header("Cache-Control: no-store, no-cache, must-revalidate");
	$name = $_GET['name'];
	$query = 'SELECT pages, description, private, id FROM wa_storyboards WHERE name=\'' . $name . '\'';
	$result = pg_query($conn, $query) or die('Database error');
	$row = pg_fetch_array($result);
	$npages = $row[0];
	$desc = $row[1];
	$is_private = ($row[2] == "t");
	$bid = $row[3];
	$has_access = true; #If it's a public board, anyone has access
	if($is_private)
		echo 'GOOD';

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

		if(has_cookies() and $is_private) {

			$query = 'SELECT user_id FROM wa_users WHERE username=\'' . $_COOKIE['username'] . '\'';
			$result = pg_query($conn, $query) or die('Database error');
			$row = pg_fetch_array($result);
			$uid = $row[0];

			$query = 'SELECT uid FROM wa_ownership WHERE bid=\'' . $bid . '\'';
			$result = pg_query($conn, $query) or die('Database error');
			$row = pg_fetch_array($result);
			$oid = $row[0];

			$has_access = ($oid == $uid);
		}

		storyboard($name, $npages);

		$title = '';
		#if($has_access)
		#	echo 'OK';
		if($has_access) {
			$title = "\"Edit this image! <a href=\'javascript:open_editor();\'  style=\'color: #CC0000\' target=\'_parent\' >Launch Editor</a>\";";
		}



		if(has_cookies() && $has_access) {
			echo '<script> function open_editor()'
				. '{' 
					. ' var lastImage = document.getElementById("lastImage");'
					. '$.fancybox.close();' 
					. ' if (lastImage.className == "storyboard")'
					. ' {'
						. ' turnedOff = true;'
						. '	lastImage.className = "storyboard fancybox.iframe";'
						. ' lastImage.href = "./paint.php?b='. $name . '&f=' . $npages . '";'
						. ' lastImage.title ="<a href=\'javascript:open_editor();\'  style=\'color: #CC0000\' target=\'_parent\' >Close Editor</a>";'
					. '} else '
					. '{' 
						. ' turnedOff = false;'
						. ' lastImage.className = "storyboard";'
						. ' lastImage.href = "./storyboard/'. $name . '/' . $npages. '.png";'
						. ' lastImage.title = ' . $title
					. '}'
					. 'lastImage.click();'
				. '}; </script>' ;
			echo '<div id="adminsection">';
			echo '<input type=\'button\' value=\'Add new page\' onclick="add_page()" />';
			echo '<input type=\'button\' value=\'Delete last page\' onclick="delete_page()" />';
			#echo '<a href=\'board.php?name=' . $name . '&addpage=true\'>Add Page</a><br />';
			#echo '<a href=\'board.php?name=' . $name . '&delete=true\'>Delete</a>';
			echo '</div><br />';
				echo '<div class="fb-comments" data-href="http://129.31.210.128/board.php/name='. $name .' data-width="600" data-num-posts="3"></div>';
	
		} else {
			echo '<script>'
					. ' var lastImage = document.getElementById("lastImage");' 
					. ' lastImage.title = "" ;'
				. '</script>';
		}
		
		echo '<div id=\'description\'>';
		echo $desc;
		echo '</div>';



		
		echo '</div>';
		



?>

<?php include_once('footer.php'); ?>
