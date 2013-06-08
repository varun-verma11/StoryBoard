<!DOCTYPE html>

<html>
	<head>
        <meta charset="UTF-8">
    	<link rel="stylesheet" href="./SkyBrush/skybrush/css/skybrush.css" />
        <?php
            header('X-Frame-Options: GOFORIT'); 
            $board = $_GET['b'];
            $frame = $_GET['f'];
            $filepath = "./Images/" . $board . "/" . $frame . ".png";
            $age = time()-filemtime($filepath);

            if (!file_exists($filepath) or $age<10)
            {
                echo '<meta http-equiv="refresh" content="0; url=./NonExistentFrame.html">';
            }
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

        <script src="./SkyBrush/skybrush/js/skybrush.js"></script>
        <script src="./SkyBrush/skybrush/js/jquery-1.8.2.min.js"></script>
        <script src="./SkyBrush/skybrush/js/jquery.more.js"></script>

        <script>
            var dom = $( '.skybrush' );
            var skybrush = new SkyBrush( dom, {
                image_location: './SkyBrush/skybrush/images/skybrush/'
            });
            var isSaved = true;
            var filepath = "<?php echo $filepath ?>";
            var img  = new Image();
            img.src = filepath;
            skybrush.setImage(img);

            skybrush.onDraw( function() {
                isSaved = false;
            });
            jQuery(window).bind(
                "beforeunload", 
                function() { 
                    saveCanvas();
                }
            );
            $(document).ready(function () {
                window.setInterval(saveCanvas, 5000);
            });

            function saveCanvas()
            {
                // if (isSaved) {
                //     return;
                // }
                var img = skybrush.getImageData("image/png");
                var ajax = new XMLHttpRequest();
                img = filepath + "#" + img;
                ajax.open("POST", './testSave.php', false);
                ajax.setRequestHeader('Content-Type', 'application/upload');
                ajax.send(img);
                isSaved = true;
            };
        </script>
    </body>
</html>
