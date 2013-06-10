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

	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			$('.storyboard').fancybox({
 				//openEffect  : 'none',
 				//closeEffect : 'none',
 				wrapCSS    : 'fancybox-custom',
 				prevEffect : 'elastic',
 				nextEffect : 'elastic',
 				closeBtn  : false,
 				arrows    : false,
 				nextClick : true,
 				helpers : {
  					title : {
   						type : 'outside'
						    },
  					buttons : {},
  					thumbs : {
   						width : 70,
   						height : 70
  					},

  					overlay: {
    					opacity: 2, 
    					css: {'background-color': '#000000'} 
   					}
 				},

			//in case we want to resize images, change the width here...
 /*				beforeShow: function () {
   					 // set new fancybox width

    				var newWidth = this.width * 2;
    				// apply new size to img
    				$(".fancybox-image").css({
      					"width": newWidth,
      					"height": "auto"
    				});
    				// set new values for parent container
    				this.width = newWidth;
    				this.height = $(".fancybox-image").innerHeight();
  					},
*/
				

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				autoSize : false,
				//fitToView: true,
				width:900,
  				height:900,
  				 titleShow : true,

  //autoResize:false

 				 afterLoad : function() {
  			 		this.title = ' Frame ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				  }
				});

			/*
			 *  Different effects
			//  */
	


			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});



			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
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
				. $number
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