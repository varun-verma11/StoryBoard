<?php include_once('header.php'); ?>

<?php

	$tags = array();

	if(isset($_POST['tags'])) {
		$str = $_POST['tags'];
		$tok = strtok($str, " ");
		while($tok !== false) {
			$tags[] = $tok;
			$tok = strtok(" ");
		}
		$tags = array_unique($tags);
	}

	if(isset($_POST['submitted_to_edit'])) {

		$name = $_GET['name'];
		$errors = array();
		$board_description = $_POST['description'];
		$privacy = $_POST['privacy'];

		$query = 'SELECT id FROM wa_storyboards WHERE name=\'' . $name . '\'';
		$result = pg_query($conn, $query) or die('Database error 0');
		$row = pg_fetch_array($result);
		$bid = $row[0];

		if(empty($board_description))
			$errors[] = "Please give a description for your board";

		if(!empty($errors)) {
			echo '<ul>';
			foreach($errors as $err)
				echo '<li>' . $err . '</li>';
			echo '</ul>';
		} else {

			$query = 'UPDATE wa_storyboards SET description=\''. $board_description . '\', private='
					. $privacy
					. ' WHERE name=\'' . $name .'\'';
			pg_query($conn, $query) or die('Database error 1');

			$query = 'DELETE FROM wa_tags WHERE bid=' . $bid;

			pg_query($conn, $query) or die('Database error 2');

			foreach($tags as $tag) {
					$query = 'INSERT INTO wa_tags(tag, bid) VALUES ' . '(\'' . $tag . '\', ' . $bid . ')';
					#echo '<li>' . $query . '</li>'; 
					pg_query($conn, $query) or die('Database error 3');
				}

			echo 'Board updated succesfully!';
		}

	} elseif(isset( $_POST['submitted'] ) ) {

		$privacy = $_POST['privacy'];
		$errors = array();
		$board_name = $_POST['boardname'];
		$board_description = $_POST['description'];

		if(empty($board_name))
			$errors[] = "Please enter a board name";
		else {
			$get_board = 'SELECT * FROM wa_storyboards WHERE name=\'' . $board_name . '\' LIMIT 1';
			$result = pg_query($conn, $get_board);
			if(pg_fetch_array($result))
				$errors[] = "A board with the same name already exists";

		}

		if(empty($board_description))
			$errors[] = "Please give a description for your board";
		if(!empty($errors)) {
			echo '<ul>';
			foreach($errors as $err)
				echo '<li>' . $err . '</li>';
			echo '</ul>';
		} else {
			#Board creation goes here:
			$path = 'storyboard/' . $board_name . '/';
			if(create_physical_board($path)) {

				$uid_query = 'SELECT user_id FROM wa_users WHERE username=\'' . $_COOKIE['username'] .'\'';
				$bid_query = 'SELECT id FROM wa_storyboards WHERE name=\'' . $board_name . '\'';
				$add_board_query = 'INSERT INTO wa_storyboards (name, description, private) VALUES (\''. $board_name .'\', \''. $board_description .'\', ' . $privacy . '); ';
			
				pg_query($conn, $add_board_query) or die('Database connection error');
			
				$result = pg_query($conn, $uid_query) or die('Database error');
				$row = pg_fetch_array($result);
				$uid = $row['user_id'];

				$result = pg_query($conn, $bid_query) or die('Database error');
				$row = pg_fetch_array($result);
				$bid = $row['id'];

			
				$add_boad_owner = 'INSERT INTO wa_ownership (uid, bid) VALUES ' . '(\''. $uid . '\', \'' . $bid . '\');';
			
				foreach($tags as $tag) {
					$query = 'INSERT INTO wa_tags(tag, bid) VALUES ' . '(\'' . $tag . '\', ' . $bid . ')';
					pg_query($conn, $query) or die('Database error 3');
				}

				pg_query($conn, $add_boad_owner) or die('Database error');
			

				echo 'Board "' . $board_name . '" succesfully created!';
			} else {

				echo 'Cannot add folder';

			}

		}

	} elseif(isset($_GET['delete'])) {

		$bid = $_GET['delete'];
		$delete_query = 'DELETE FROM wa_storyboards WHERE id=\'' . $bid . '\'; DELETE FROM wa_ownership WHERE bid=\'' . $bid . '\'';
	#	

		$name_get_query = 'SELECT name FROM wa_storyboards WHERE id=\'' . $bid . '\'';
		$result = pg_query($conn, $name_get_query) or die('Database error');
		$row = pg_fetch_array($result);
		$board_name = $row['name'];

		pg_query($conn, $delete_query) or die('Database error');

		$path = 'storyboard/' . $board_name . '/';
		deleteDir($path);

	}

	$can_edit = $_GET['edit'];
	$name = '';
	$desc = '';
	$bid = 0;
	if($can_edit) {
		$name = $_GET['name'];
		$query = 'SELECT description, id FROM wa_storyboards WHERE name=\'' . $name . '\'';
		$result = pg_query($conn, $query) or die('Database error');
		$row = pg_fetch_array($result);
		$desc = $row[0];
		$bid = $row[1];
	}
?>

<?php 
	if(!$can_edit) { 
?>

<form action="boards.php" method="post">
	<?php } else {
		echo '<form action="boards.php?name=' .$name . '" method="post">';
	}
	?>

<?php if(!$can_edit) { ?>
<br />
<h2>Create new board</h2>
<?php } else { ?>
<a href="boards.php">Create new board</a>

<h2>Edit this board</h2>
<?php } ?>

<p>Board Name <?php if(!$can_edit) { ?> 
	<input type="text" name="boardname" size="30" maxlength="30" />
	<?php } else { echo '<p><b style="text-transform:capitalize;">' . $name . '</b></p>'; }?> 

</p>

<p>Description (max 160 characters) <textarea name="description" rows="4" cols="50" maxlength="160" ><?php if($can_edit)	echo $desc; ?>
</textarea>
<p>Tags (separed by spaces)</p>
<input type="text" name="tags" size="30" <?php
	if($can_edit) {
		$value = '';

		$query = 'SELECT tag FROM wa_tags WHERE bid=' . $bid;
		$result = pg_query($conn, $query) or die('Database error');
		while($row = pg_fetch_array($result)) 
			$value = $value . $row[0] . ' ';
		echo 'value=\'' . $value . '\'';

	}
 ?>/>
<p>Privacy 
	<select name="privacy">
	<option value="false">Public</option>
	<option value="true">Private</option>
	</select>
</p>

<?php 
	if(!$can_edit) {
?>

<input type="hidden" name="submitted" value="1" />
<p><input type="submit" name="submit" value="Create" class="button" /></p>
<?php

} else {
?>
<input type="hidden" name="submitted_to_edit" value="1" />
<p><input type="submit" name="submit" value="Update" class="button" /></p>
<?php
	}
?>
</form>
<hr />
<h2>Manage Boards</h2>

<?php

	$uid_query = 'SELECT user_id FROM wa_users WHERE username=\'' . $_COOKIE['username'] .'\'';
	$result = pg_query($conn, $uid_query) or die('Database error');
	$row = pg_fetch_array($result);
	$uid = $row['user_id'];

	$user_boards_query = '(SELECT wa_storyboards.name, wa_ownership.bid
FROM wa_storyboards
INNER JOIN wa_ownership
ON wa_storyboards.id = wa_ownership.bid
INNER JOIN wa_users
ON wa_users.user_id = wa_ownership.uid
WHERE wa_users.user_id='. $uid . ')';
	
	$results = pg_query($conn, $user_boards_query);
	echo '<table border=\'1\'>';
	while($row = pg_fetch_array($results)) {
		#HUGE SERURITY RISK:
		echo '<tr><td>' . $row[0] . '</td><td><a href="/board.php?name='. $row[0] .'">Use Board</a></td><td><a href=\'boards.php?delete='. $row[1] .'\'>Delete Board</a></td>'
		.'<td><a href="/boards.php?name='. $row[0] .'&edit=true">Edit Board</a></td>'
		.	'</tr>';
	

	}
	echo '</table>';
?>


<?php include_once('footer.php'); ?>
