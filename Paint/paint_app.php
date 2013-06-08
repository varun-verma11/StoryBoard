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

            if (!file_exists($filepath))
            {
                echo '<meta http-equiv="refresh" content="0; url=./NonExistentFrame.html">';
            }
        ?>

        <script type="text/javascript">
            var board = "<?php echo $board; ?>";
            var frame = "<?php echo $frame; ?>";
            var filepath = "./Images/" + board + "/" + frame + ".png";
            var fp = filepath;

            function image_being_edited(url)
            {
                /*
                    This function will consult the database to check
                    if the current picture is being edited or not.
                    Currently returns false by default.
                */
                return false;
            };

        </script>
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
            var isSaved = false;
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
                if (isSaved) {
                    return;
                }
                var img = skybrush.getImageData("image/png");
                var ajax = new XMLHttpRequest();
                // var fp = "<?php echo $_GET['fp']; ?>";
                img = filepath + "#" + img;
                ajax.open("POST", './testSave.php', false);
                ajax.setRequestHeader('Content-Type', 'application/upload');
                ajax.send(img);
                isSaved = true;
            };
        </script>
    </body>
</html>
