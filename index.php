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

		$left = $i%3 == 0;
		$name = $row['name'];

		if($left) {
			if($i>0)
				echo '<div>';	
			echo '<div class=\'row\'>';
		}

#	  <div class="row">
#        <div class="col-md-4 portfolio-item">
#          <a href="#project-link"><img class="img-responsive" src="http://placehold.it/700x400"></a>
#          <h3><a href="#project-link">Project Name</a></h3>
#          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
#        </div>
#      </div>


		echo '<div class=\'col-md-4 portfolio-item\'>';
		echo '<img class="img-responsive" width="300px" height="300px" src=\'storyboard/' 
		. $name . '/0.png\'>';

		echo '<h3><a href=\'board.php?name=' .
			 $name . '\'>' . $name . '</a></h3>';
		
		echo '</div> '; #Post title close

		
		$i++;
	}
	#if(!$left)
	echo '</div>';

?>

<?php
?>
	<div align="center" id="pagenav">
		Pages:
		<ul class="pagination">
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
		echo ' <li><a href=\'index.php?p=' . ($page+1) . '\'> Next Page &gt;&gt; </a></li>';

	?>
		</ul>
	</div>
	<?php

?>


<?php
include_once('footer.php');
?>
