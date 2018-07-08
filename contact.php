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
	
    <title>Contact Us</title>
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
        <div class="contact_info">
						<h2>Contact us </h2>
			    	 		<div class="map">
					   			<iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3771.6400479483937!2d73.02062871490058!3d19.035576587111052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c3db667e6227%3A0x211c75f6b08e5123!2sSIES+College+of+Management+Studies+(SIESCOMS)!5e0!3m2!1sen!2sin!4v1476194915214" width="600" height="450" frameborder="0" style="border:0" allowfullscreen"></iframe><br><small><a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3771.6400479483937!2d73.02062871490058!3d19.035576587111052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c3db667e6227%3A0x211c75f6b08e5123!2sSIES+College+of+Management+Studies+(SIESCOMS)!5e0!3m2!1sen!2sin!4v1476194915214" width="600" height="450" frameborder="0" style="border:0" allowfullscreen">View Larger Map</a></small>
					   		</div>
      				</div><b>
					<h3>Address :</h3><p>ss-2, sector-16, jyoti apartment, room no: 136,
					<br>koperkhairne, navi mumbai-400709</p>
					<h3>E-mail :</h3><p>techapt01@gmail.com</p>
					<h3>Contact No :</h3><p>9699689997</p></b>
        
<hr/>
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

