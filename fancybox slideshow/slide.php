<!DOCTYPE html>
<html>
<head>
	<title>Slideshow work</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Add jQuery library -->
	<script type="text/javascript" src="./fancybox/lib/jquery-1.9.0.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="./fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="./fancybox/source/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="./fancybox/source/jquery.fancybox.css?v=2.1.4" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="./fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="./fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="./fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="./fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<script type="text/javascript" src="slideshow.js">
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
</head>
<body>
	<?php
		storyboard("Board");

		function storyboard($name)
		{
			heading($name);
			html_break();
			paragraph(generate_slideshow($name));
		}

		function heading($name)
		{
			echo '<h3>' . $name . '</h3>';
		}

		function paragraph($text)
		{
			echo '<p>' . $text . '</p>';
		}

		function html_break()
		{
			echo '<br>';
		}

		function generate_slideshow($name)
		{
			$num_images = get_number_of_images($name);
			echo cover_pic($name);
			echo all_pics($name, $num_images);
		}

		function cover_pic($name)
		{
			echo '<a class="storyboard" data-fancybox-group="' 
				. $name 
				. '" href="./' 
				. $name 
				. '/1.png"> <img width="150" height="100"'. ' src=./'
				. $name
				. '/0.png alt ="1" /> </a>'
				. ' ' ;
		}

		function get_number_of_images($name)
		{
			return 10;
		}

		function all_pics($name, $num_images)
		{
			for ($i=1; $i<=$num_images; $i++)
			{
				echo_img_for_slideshow($name, $i);
			}
			echo_addimg($name, $i); //get last image and storyboard name
		}

		function echo_addimg($name, $number)
		{//" title="test title"

			echo '<a class="storyboard fancybox.iframe" data-fancybox-group="'
				. $name
				. '" href="../Paint/paint_app.php?b='
				. 'Board'
				. '&f='
				. '1'
				. '" </a>'
				. ' '; 
			/*
			echo '<a class="storyboard fancybox.iframe" data-fancybox-group="'
				. $name
				. '" href="../Paint/paint_app.php?b='
				. $name
				. '&f='
				. ($number)
				. '" </a>'
				. ' '; 
				*/
		}


		function echo_img_for_slideshow($name, $number)
		{//get title/caption using name and number from database
			//for now
			// echo '<a class="storyboard" data-fancybox-group="'
			// 	. $name
			// 	. '" title="Edit this image! <a href=\'../Paint/paint_app.php?b=Board&f=1\'>Launch editor</a>" href="./'
			// 	. $name 
			// 	. '/'
			// 	. strval($number)
			// 	. '.png" </a>'
			// 	. ' ';

			echo '<a class="storyboard" data-fancybox-group="'
				. $name
				. '" title="Edit this image! <a href=\'../Paint/paint_app.php?b='
				. $name
				. '&f='
				. strval($number)
				. '\'>Launch editor</a>" href="./'
				. $name 
				. '/'
				. strval($number)
				. '.png" </a>'
				. ' ';

		}

	?>

</body>

</html>