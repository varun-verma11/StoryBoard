<?php
include_once('config.php');
include_once('functions.php');
 ?>
<!DOCTYPE HTML>
<html>
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
?>
<head>
<!--<link rel="stylesheet" type="text/css" href="style.css" />-->


<title>Story Board</title>
<!-- Import these just in board.php TODO -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <link rel="stylesheet" type="text/css"  href="css/3-col-portfolio.css" media = "screen"/>
	<script type="text/javascript"> var turnedOff = false;</script>
	<link href="favicon.ico" rel="icon" type="image/x-icon" />
    <!-- Add Twitter Bootstrap-->
	<script src="js/bootstrap.min.js"></script>
  <link href="css/bootstrap.css" rel="stylesheet" media="screen" />
  <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen" />
  
  <link href="css/bootstrap_aux.css" rel="stylesheet" media="screen" />
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

	<script type="text/javascript" src="./slideshow.js"></script>
	<script type="text/javascript" src="./scripts.js"></script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
</head>
<body>

<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=120897128120261";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>




<div class="navbar navbar-inverse nav">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/">Home</a>
      <ul class="nav">
      <li><a href="randomboard.php">Random Board</a></li>
      </ul>
      <!-- {% if loggedIn %} -->
      <?php if( has_cookies() ) { ?>
        <div class="nav-collapse collapse">
          <div class="pull-right">
            <ul class="nav pull-right">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, 
              <?php echo $_COOKIE['username'];  ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  
          		    <li><a href="changepass.php">Change Password</a>
          		    	<i class="glyphicon glyphicon-cog"></i>
          		    </li>
					<li><a href="boards.php">Boards Panel</a>
						<i class="glyphicon glyphicon-cog"></i>
					</li>
					<li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
  	                <?php } else {?>
  	                	<div class="pull-right">
  	                	<a class="btn btn-success" href="login.php">Sign in</a>
        				<a class="btn btn-primary" href="register.php">Sign up</a>
        				</div>
  	                <?php } ?>
                  <li class="divider"></li>
                  
                </ul>
              </li>
            </ul>
          </div>
        </div>
      <!--{% endif%}-->
    </div>
  </div>
</div>

<div class="container">
<div class="page-header">

<h1>FancyBoards</h1>
<h2><small>Drawing just got social!</small></h2>
<!-- <a id="logo" href="/"></a>  --><!-- Main logo -->


</div> <!-- header div -->
<!-- <hr /> We don't need you anymore -->
<div id="content">

<?php
?>