<?php
if (isset($GLOBALS["HTTP_RAW_POST_DATA"]))
{
    $name=$GLOBALS['HTTP_RAW_POST_DATA'];
    $fp = "./storyboard/" . $name . "/.lock";
    unlink($fp);
}
?>
