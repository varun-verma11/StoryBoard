<!DOCTYPE HTML>
<html>
<head>
    <title>StoryBoard</title>
    <!-- note : in HTML5 no need to specify type=...-->
    <link rel="stylesheet" href="css/paint.css"/>
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/paint.js"></script>
    <script src="js/drawingtools.js"></script>
    <!-- add this if you are not running in Opera and want a color chooser -->
    <script src="js/jscolor/jscolor.js"></script>
    <script type="text/javascript">
        // Run when the DOM is ready
        $(document).ready(function () {
            // Create the pseudo object which will handle the main canvas
            paint = new PaintObject("canvasMain");
            // Bind events to the canvas
            paint.bindMultiplexEvents();
        });
        jQuery(window).bind(
            "beforeunload", 
            function() { 
                saveCanvas();
            }
        );

        $(document).ready(function () {
            // Configure to save every 5 seconds
            window.setInterval(saveCanvas, 60000);
        });

        function saveCanvas()
        {
            var img = document.getElementById("canvasMain").toDataURL("image/png");
            var ajax = new XMLHttpRequest();
            var fp = "<?php echo $_GET['fp']; ?>";
            if (fp=="") {
                return;
            }
            // var fp = prompt("Please enter the name of the file.");
            img = "Images/" + fp + ".png#" + img;
            ajax.open("POST", 'testSave.php', false);
            ajax.setRequestHeader('Content-Type', 'application/upload');
            ajax.send(img);
        };
    </script>
</head>
<body>
<div id="home">
    <div id="content">
        <div id="divCanvas">
            <canvas id="canvasMain">
                <p>Canvas tag not supported by your browser</p>
            </canvas>
        </div>

    </div>
    
    <div id="righColumn">
        <div id="drawCommands">
            <h6>Pick a tool</h6>
            <span id="line">Line</span>
            <span id="pencil">Pencil</span>
            <span id="rectangle">Rectangle</span>
            <span id="circle">Circle</span>
            <span id="text">Text</span>
            <span id="eraser">Eraser</span>
            <br>
            <ul>
                <li>
                    Text Size: 
                    <select id="font_size">
                        <option value="6">6</option>
                        <option value="8">8</option>
                        <option value="10">10</option>
                        <option value="12">12</option>
                        <option value="14" selected="selected">14</option>
                        <option value="16">16</option>
                        <option value="18">18</option>
                        <option value="20">20</option>
                        <option value="24">24</option>
                        <option value="28">28</option>
                        <option value="32">32</option>
                    </select>
                </li>
                <li>
                    Font: 
                    <select id="font">
                        <option value="arial"> Arial</option>
                        <option value="Calibri">Calibri</option>
                        <option value="Comic Sans MS">Comic Sans SF</option>
                        <option value="impact">Impact</option>
                        <option value="Sans Serif"> Sans Serif</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Times New Roman">Times New Roman</option>
                    </select>
                </li>   
                <li>
                    Fill color:
                    <!-- if running opera you may try : <input id="fillColor" type="color" value="FFFFFF"/> -->
                    <input id="fillColor" class="color" value="FFFFFF"/>
                </li>
                <li>
                    Stroke color:
                    <!--  if running opera you may try :<input id="strokeColor" type="color" value="FFFFFF"/> -->
                    <input id="strokeColor" class="color" value="000000"/>
                </li>
                <li>
                    <!-- works only in Chrome and Opera, will display a standard input text in Firefox -->
                    Stroke size: <input id="strokeSize" type="range" min="0" max="20" value="1" step="0.5" style="position:relative;top:6px;"/>
                </li>
                <li>
                    Fill shapes : <input id="fillShapes" type="checkbox" checked/>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>