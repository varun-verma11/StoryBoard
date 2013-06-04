<?php include_once('header.php'); ?>

<form action="boards.php" method="post">
<h2>Create new board</h2>
<p>Board Name <input type="text" name="boardname" size="30" maxlength="30" /></p>
<p>Description (max 160 characters) <textarea rows="4" cols="50" maxlength="160"></textarea>
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
