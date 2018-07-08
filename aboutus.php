<?php
error_reporting(0);
session_start();
      
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Know Us</title>
    <link type="text/css" href="css/bootstrap.css" rel="stylesheet" />
	<link type="text/css" href="css/style.css" rel="stylesheet" />
  </head>
  <body background="images/back/11.png">
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
<?php } else { ?>
	 <ul class="nav navbar-nav navbar-right">
	  <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
    </ul>

<?php
}
?>
  </div>
</nav>
<!--End of Header-->
<div class="container">

        <!-- Introduction Row -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">About Us
                    <small>It's Nice to Meet You!</small>
                </h1>

                <p><b>TechApt is an platform made available for students who are planning to crack technical aptitude for their dream jobs. TechApt provides technical questions for all the computer science related subjects. Welcome to TechApt!!</b></p>
            </div>
        </div>

        <!-- Team Members Row -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">Our Team</h2>
            </div>
                <div class="col-lg-3 col-sm-6">
                <img class="img-circle img-responsive img-center" src="images/rahul.JPG" height="200" width="200" alt="Rahul">
                <h3>Rahul Pandey
                    <small>Developer</small>
                </h3>
                <p>rahul.f444@gmail.com</p>
            </div>
        </div>

        <hr>

    </div>
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