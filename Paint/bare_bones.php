<!DOCTYPE html>
<html>
	<head>
    	<link rel="stylesheet" href="./SkyBrush/skybrush/css/skybrush.css" />
        <?php
            header('X-Frame-Options: GOFORIT'); 
        ?>
    </head>
    <style>
        html, body {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            /*overflow: hidden;*/
        }
    </style>
    <body>
    	<div class="skybrush"></div>
    </body>

    <script src="./SkyBrush/skybrush/js/skybrush.js"></script>
    <script src="./SkyBrush/skybrush/js/jquery-1.8.2.min.js"></script>
    <script src="./SkyBrush/skybrush/js/jquery.more.js"></script>

    <script>
        var dom = $( '.skybrush' );
        var skybrush = new SkyBrush( dom, {
            image_location: './SkyBrush/skybrush/images/skybrush/'
        });

        jQuery(window).bind(
            "beforeunload", 
            function() { 
                saveCanvas();
            }
        );

        $(document).ready(function () {
            window.setInterval(saveCanvas, 60000);
        });

        function saveCanvas()
        {
            var img = skybrush.getImageData("image/png");
            var ajax = new XMLHttpRequest();
            var fp = "<?php echo $_GET['fp']; ?>";
            if (fp=="") {
                return;
            }
            img = "./Images/" + fp + ".png#" + img;
            ajax.open("POST", './testSave.php', false);
            ajax.setRequestHeader('Content-Type', 'application/upload');
            ajax.send(img);
        };
    </script>
</html>
