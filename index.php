<?php 
include_once('header.php');
?>
<?php

	$page = 1;
	$boards_per_pages = 6;

	$query = 'SELECT count(*) FROM wa_storyboards';
	$result = pg_query($conn, $query);
	$row = pg_fetch_array($result);
	$num_boards = $row[0];
	$pages = ceil($num_boards / $boards_per_pages);

	if(isset($_GET['p'])) {
		$page = $_GET['p'];
	}

	$query = 'SELECT * FROM wa_storyboards ORDER BY creation_date OFFSET ' 
	. (($page-1) * $boards_per_pages) 
	. ' LIMIT ' . $boards_per_pages;
	#echo $query;

	$result = pg_query($conn, $query) or die('Database error!');

	$i = 0;
	$left = false;
	while($row = pg_fetch_array($result)) {

		$left = $i%2 == 0;
		$name = $row['name'];

		if($left)
			echo '<div class=\'postrow\'>';
		echo '<div class=\'post-';
		if($left) {
			echo 'left';
		} else {
			echo 'right';
		}
		echo '\'>';

		echo '<div class=\'posttitle\'> ';


		echo '<h2><a href=\'board.php?name=' .
			 $name . '\'>' . $name . '</a></h2>';
		echo '</div> '; #Post title close
			echo '<div class=\'postcontent\'>';

			echo '<div class=\'postimage\'>';
			echo '<img src=\'storyboard/' . $name . '/0.png\' />';
			echo '</div>'; #Post image close
		
		echo '<p>' . $row['description'] . '</p>';

		echo '</div>'; #Post content close
			
		
		echo '</div>'; #Post close
		if(!$left)
			echo '</div>';
		echo '<br />';
		$i++;
	}
	if($left)
		echo '</div>';

?>

<?php
?>
	<div align="center" id="pagenav">
		Pages:
	<?php
	#Pages area:
	if($page > 1)
		echo '<a href=\'index.php?p=' . ($page-1) . '\'> &lt;&lt; Previous Page </a>';
	for($i=1; $i<=$pages; $i++) {
		$ok = $i!=$page;
		if($ok)
			echo '<a href=\'index.php?p=' . $i . '\'>';
		echo $i;
		if($ok)
			echo '</a>';

	}
	if($page < $pages)
		echo '<a href=\'index.php?p=' . ($page+1) . '\'> Next Page &gt;&gt; </a>';

	?>
	</div>
	<?php

?>


<?php
include_once('footer.php');
?>
