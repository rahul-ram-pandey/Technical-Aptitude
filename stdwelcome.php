<?php
error_reporting(0);
session_start();
        if(!isset($_SESSION['stdname'])){
        	  echo "<div class=\"alert alert-success\" role=\"alert\"><b>";
             $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a>. </b></div>";
			 header('Location: index.php');
        }
        else if(isset($_REQUEST['logout'])){
                unset($_SESSION['stdname']);
                 echo "<div class=\"alert alert-success\" role=\"alert\"><b>";
              $_GLOBALS['message']="You are Loggged Out Successfully </b></div>";
        }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Welcome Page</title>
    <link type="text/css" href="css/bootstrap.css" rel="stylesheet" />
	<link type="text/css" href="css/style.css" rel="stylesheet" />
	
  </head>
  <body background="images/back/5.png">
<?php

        if($_GLOBALS['message'])
        {
         echo "<div>".$_GLOBALS['message']."</div>";
        }
      ?>
 <!--Header--> 
<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
      <div class="navbar-header">
           <span class="navbar-brand" style="color:#ffffff; font-size:x-large;">Tech Apt</span>
       </div>
      <ul class="nav navbar-nav">
	    <li class="active"><a href="stdwelcome.php">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="feedback.php">Feedback</a></li> 
      </ul>
	  
    <ul class="nav navbar-nav navbar-right">
      <?php if(isset($_SESSION['stdname'])){ ?>
      <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
	  
    </ul>
<p class="navbar-text navbar-right">Signed in as <a href="editprofile.php" class="navbar-link"><?php echo " ".$_SESSION['stdname']." "; ?></a></p>
<?php } ?>
  </div>
</nav>
<!--End of Header-->


<div class="row">
	<div class="col-md-3">
	
	</div>
	
	<div class="col-md-6">
		<div class="row">
			<div class="well col-md-5">
			<h4>Take Test</h4>
			<a href="stdsubject.php"><img src="images/take_test.png" class="img-responsive img-thumbnail" /></a>
			
			</div>
			<div class="col-md-2"></div>
			<div class="well col-md-5">
			<h4>View Result</h4>
			<a href="viewresult.php"><img src="images/results.jpg" class="img-responsive img-thumbnail" /></a>
			
			</div>
			
		</div>
		<div class="row">
			<div class="well col-md-5">
			<h4>Resume Test</h4>
			<a href="resumetest.php"><img src="images/resume_test.png" class="img-responsive img-thumbnail" /></a>
			
			</div>
			<div class="col-md-2"></div>
			<div class="well col-md-5">
			<h4>Update Profile</h4>
			<a href="editprofile.php"><img src="images/update.jpg" class="img-responsive img-thumbnail" /></a>
			
			</div>
		</div>
	</div>
	
	<div class="col-md-3">
	
	</div>
</div>
<br></br>
<!--Footer-->
<div class="navbar navbar-inverse navbar-static-bottom">
	
		<div class="container-fluid">
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