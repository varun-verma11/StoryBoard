function open_editor()
{
	var lastImage = document.getElementById("lastImage");
	if (lastImage.className == "storyboard")
	{
		lastImage.className = "storyboard fancybox.iframe";
		lastImage.href = "./paint.php?" ;

	} else 
	{
		lastImage.className = "storyboard";
		lastImage.href = " ";
	}

	var lastImage = document.getElementById("lastImage");
	if (lastImage.className == "storyboard fancybox.iframe")
	{
		lastImage.className = "storyboard";
		lastImage.href = " ";
	}
}