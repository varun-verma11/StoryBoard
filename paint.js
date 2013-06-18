function saveCanvas()
{
    var img = skybrush.getImageData("image/png");
    var ajax = new XMLHttpRequest();
    img = filepath + "#" + img;
    ajax.open("POST", "./saveImage.php", false);
    ajax.setRequestHeader("Content-Type", "application/upload");
    ajax.send(img);
};

function endOfEdit()
{
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "./releaseLock.php", false);
    ajax.setRequestHeader("Content-Type", "application/upload");
    ajax.send(name);   
    saveCanvas();
}