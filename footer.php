


</div> <!-- content -->
<div id="footer">
<div id="tagcloud">
<?php
	$query = 'SELECT DISTINCT tag, COUNT(tag) as a FROM wa_tags GROUP BY tag ORDER BY tag ASC';
	$result = pg_query($conn, $query);
	while($row = pg_fetch_array($result)) {

		echo '<span style="font-size:'. ($row[1]+14) .'pt ;"><a href=\'tags.php?tag=' . $row[0] .'\'>' . $row[0] . '</a></span>'. ' ';

	}
?>
</div>
<div id="copywrite">
&copy; Mihai Jiplea, Rohan Mahtani, Varun Verma
</div>
</div>
</div> <!-- wrap -->



</body>
</html> 
<?php

?>
