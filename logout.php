
 <?php
 
      error_reporting(0);
	  session_start();
	  session_destroy();
	   unset($_SESSION['stdname']);
	   unset($_SESSION['stdid']);
             echo "<div class=\"alert alert-success\" role=\"alert\"><b>";
              $_GLOBALS['message']="You are Loggged Out Successfully. Click <a href=\"index.php\" class=\"alert-link\">Here</a> to LogIn </b></div>";
            
      session_destroy();
	  if(!isset($_SESSION['stdname']))
	  {
	  $logout=true;
      }
	  else
	  {
	  $logout = false;
	  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Logout Page</title>
    <link type="text/css" href="css/bootstrap.css" rel="stylesheet" />
	<link type="text/css" href="css/style.css" rel="stylesheet" />
	
  </head>
  <body background="images/back/3.png">
<?php

        if($_GLOBALS['message'])
        {
         echo "<div class=\"\">".$_GLOBALS['message']."</div>";
        }
      ?>
 <!--Header--> 
<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
      <div class="navbar-header">
           <span class="navbar-brand" style="color:#ffffff; font-size:x-large;">Tech Apt</span>
       </div>
      <ul class="nav navbar-nav navbar-right">
	    <li class="active"><a href="#">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="feedback">Feedback</a></li> 
      </ul>
    <ul class="nav navbar-nav navbar-right">
	  <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
    </ul>

  </div>
</nav>

<p><br><br><br></p>
<?php
		if($logout) 
		{
      ?>
      
       <div class="container">
     <div class="bs-callout bs-callout-success">
      <h4>Logged out successfully.</h4>
      <a href="index.php" class="alert-link">Login Now</a>
   </div>
     </div> 
                
        

        <?php  }
          
          ?>


<!--Footer-->
<div class="navbar navbar-inverse navbar-fixed-bottom">
	
		<div class="container">
			<div style="padding-top:10px">
			 <p style="color:#ffffff; font-size:15px; text-align:center; "><span class="glyphicon glyphicon-copyright-mark"></span> copyright TechApt
				<span class="glyphicon glyphicon-registration-mark"></span> 
			</p>
			</div>
		
	</div>
</div>

	
	<script> src="js/jquery-3.1.0.min"</script>
	<script> src="js/bootstrap.js"</script>
	
  </body>
</html>