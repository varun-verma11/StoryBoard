


</div> <!-- content -->
<div id="footer">
<div id="tagcloud">
<?php
	$query = 'SELECT DISTINCT tag, COUNT(tag) as a FROM wa_tags GROUP BY tag ORDER BY tag ASC';
	$result = pg_query($conn, $query);
	
	while($row = pg_fetch_array($result)) {
		echo '<a href=\'tags.php?tag=' . $row[0] .'\' class=\'btn btn-inverse btn-mini\'><i class=\'icon-white icon-tag\'></i>' . $row[0] . '</a>
   ';
	#	echo '<span class=\'badge badge-inverse\' style="font-size:'. ($row[1]+14) .'pt ;"><a href=\'tags.php?tag=' . $row[0] .'\'>' . $row[0] . '</a></span>'. ' ';

	}
?>
</div>
<div id="copywrite">
&copy; Mihai Jiplea
</div>
</div>
</div> <!-- wrap -->



</body>
</html> 
<?php

?>
