<?php include_once('header.php'); ?>

<?php

	if(isset( $_POST['submitted'] ) ) {

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
			$uid_query = 'SELECT user_id FROM wa_users WHERE username=\'' . $_COOKIE['username'] .'\'';
			$bid_query = 'SELECT id FROM wa_storyboards WHERE name=\'' . $board_name . '\'';
			$add_board_query = 'INSERT INTO wa_storyboards (name, description) VALUES (\''. $board_name .'\', \''. $board_description .'\'); ';
			
			pg_query($conn, $add_board_query) or die('Database connection error');
			
			$result = pg_query($conn, $uid_query) or die('Database error');
			$row = pg_fetch_array($result);
			$uid = $row['user_id'];

			$result = pg_query($conn, $bid_query) or die('Database error');
			$row = pg_fetch_array($result);
			$bid = $row['id'];

			
			$add_boad_owner = 'INSERT INTO wa_ownership (uid, bid) VALUES ' . '(\''. $uid . '\', \'' . $bid . '\');';
			
			pg_query($conn, $add_boad_owner) or die('Database error');


			echo 'Board "' . $board_name . '"" succesfully created!';
			

		}

	}

?>

<form action="boards.php" method="post">
<h2>Create new board</h2>
<p>Board Name <input type="text" name="boardname" size="30" maxlength="30" /></p>
<p>Description (max 160 characters) <textarea name="description" rows="4" cols="50" maxlength="160"></textarea>
<p>Privacy 
	<select>
	<option>Public</option>
	<option>Private</option>
	</select>
</p>
<input type="hidden" name="submitted" value="1" />
<p><input type="submit" name="submit" value="Create" class="button" /></p>
</form>



<?php include_once('footer.php'); ?>
