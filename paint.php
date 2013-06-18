<?php 
    include_once('functions.php');
    $board = $_GET['b'];
    $frame = $_GET['f'];
    $filepath = "./storyboard/" . $board . "/" . $frame . ".png";
    $age = time()-filemtime($filepath);

    if (!has_cookies())
    {
        echo '<meta http-equiv="refresh" content="0; url=./index.php">';
        echo '<script> alert("Please log in before you can use the paint application."); </script>';
    } else if (!file_exists($filepath))
    {
        echo '<meta http-equiv="refresh" content="0; url=./index.php">';
        echo '<script> alert("You cannot access the images directly. Please log in first."); </script>';
    } else if ($age<6)
    {
        echo '<meta http-equiv="refresh" content="0; url=./concurrent_access.html">';
         echo '<script> alert("One of your group member is currently editing this image. Please try and edit later."); </script>';
    } else 
    {
        echo '<html>'
            . '<head>'
            . '<meta charset="UTF-8">'
            .  '<link rel="stylesheet" href="./SkyBrush/skybrush/css/skybrush.css" />'
            . '</head>'
            . '<body>'
            . '<style>'
            .   ' html, body { '
                .   ' width: 100%;'
                .   ' height: 100%;'
                .   ' padding: 0;'
                .   ' margin: 0;'
            .   '}'
            . '</style>'
            . '<div class="skybrush"></div>'
            . '<script src="./SkyBrush/skybrush/js/skybrush.js"></script>'
            . '<script src="./SkyBrush/skybrush/js/jquery-1.8.2.min.js"></script>'
            . '<script src="./SkyBrush/skybrush/js/jquery.more.js"></script>'
            . '<script src="./paint.js"> </script>'
            . '<script> var filepath="' . $filepath . '";'
                . 'var dom = $( ".skybrush" );'
                . 'var skybrush = new SkyBrush( dom, {'
                    . 'image_location: "./SkyBrush/skybrush/images/skybrush/"'
                    . '});'
                . 'var img  = new Image();'
                . 'img.src = filepath;'
                . 'skybrush.setImage(img);'
                . 'jQuery(window).bind('
                    . '"beforeunload", '
                    . 'function() { '
                    . 'saveCanvas();'
                    .   '}'
                . ');'
                . 'saveCanvas();'
                . '$(document).ready(function () {'
                    . 'window.setInterval(saveCanvas, 5000);'
                . '});'
            . '</script>'
            . '</body>'
            . '</html>';

    }
?>
