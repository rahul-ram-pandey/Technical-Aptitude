<?php
error_reporting(0);
session_start();
include_once 'dbConnection.php';
        if(!isset($_SESSION['stdname'])){
            $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
			header('Location: index.php?f=1');
        }
        else if(isset($_REQUEST['logout'])){
                unset($_SESSION['stdname']);
            $_GLOBALS['message']="You are Loggged Out Successfully.";
           
        }
		if(isset($_REQUEST['submit']))
		{
			$a = $_REQUEST['username'];
			$b = $_REQUEST['feedback'];
			     $query="insert into feedback(username,feedback) values('".$_REQUEST['username']."','".$_REQUEST['feedback']."')";

			executeQuery($query);
                
		}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Suggestions</title>
    <link type="text/css" href="css/bootstrap.css" rel="stylesheet" />
	<link type="text/css" href="css/style.css" rel="stylesheet" />
  </head>
  <body>
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
<body background="images/back/1.png">
	<div class="row">
	<div class="col-md-4">
	</div>
<div class="col-md-4">
<div class="page-header">
<h3>Feedback</h3>

</div>
<form>
	<div class="form-group">
    <label for="Username">Username</label>
    <input disabled type="name" name="username" class="form-control" id="exampleInputName" placeholder="username" value="<?php echo $_SESSION['stdname'] ?>">
  </div>
  <div class="form-group">
    <label for="feedbackmessage">Feedback</label>
    <textarea style="resize:none" class="form-control" id="feedbackmessage" placeholder="Feedback" rows="6" name="feedback"></textarea>
  </div>

  <button type="submit" class="btn btn-primary" style="background-color: #000000 !important;" name="submit">Submit</button>
  <button type="reset" class="btn btn-primary" style="background-color: #000000 !important;">Reset</button>
</form>
<div class="col-md-4">
	
		</div>
</div>

</div>
</body>
<!--Footer-->
<div class="navbar navbar-inverse navbar-fixed-bottom">
	
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