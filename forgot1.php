<?php
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Forgot Password Page</title>
    <link type="text/css" href="css/bootstrap.css" rel="stylesheet" />
	<link type="text/css" href="css/style.css" rel="stylesheet" />
	<script type="text/javascript" src="validate.js" ></script>
	
  </head>
  <body background="images/back/5.png">
  
<?php 
					
					if(isset ($_POST['stdsubmit']))
	{
					$email = $_POST['rmail'];
					$connect = mysqli_connect("localhost","root","");
					mysqli_select_db("aptitude",$connect);
					
					
						
						$email_check = mysqli_query("select * from student where emailid='".$email."'");
						$count = mysqli_num_rows($email_check);
						if($count != 0){
							$random = rand(72891,92729);
							$new_password = $random;
							
							$email_password = $new_password;
							$new_password = md5($new_password);
							
							mysqli_query("update student set stdpassword ='".$new_password."' where emailid='".$email."'");
							
							echo '<div class="alert alert-success fade in">';
								echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
							echo' Your mail has been sent successfully.';
							echo '</div>';
						}
						else{
							echo '<div class="alert alert-danger fade in">';
			echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
			echo' Incorrect Email.';
			echo '</div>';
						}
	}
				?>
				 
				
 <!--Header--> 
<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
      <div class="navbar-header">
           <span class="navbar-brand" style="color:#ffffff; font-size:x-large;">Tech Apt</span>
       </div>
      <ul class="nav navbar-nav navbar-right">
	    <li class="active"><a href="stdwelcome.php">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="feedback.php">Feedback</a></li> 
      </ul>

  </div>
</nav>
<!--end of header-->
<p><br><br><br><br><br><br></p>
<div class="container">
	<div class="row">
		<div class="col-md-4">
		<!--For left Space-->
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			 <div class="panel-heading"><b>Forgot Password</b></div>
			 <!--<div class="jumbotron text-center" style="margin-bottom:15px; padding:7px;" ><h3>Registration Form</h3></br></div> -->
				<div class="panel-body">
				<form id="forgotpassword" action="forgot1.php" method="post">
				
				 
				
				<div class="form-group">
					<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
					<input type="email" class="form-control" name="rmail" placeholder="Type your email" required/>
					</div>
				  </div>
				 
				  
				  
				  
				  <center>
				  <button type="submit" class="btn btn-default black-background white" name="stdsubmit"><span class="glyphicon glyphicon-log-in"></span>  Submit  </button>
				  <button type="reset" class="btn btn-default black-background white" name="reset"><span class="glyphicon glyphicon-log-in"></span>  Reset  </button>
				  </center>
				
				</form>
				
								</div>
							</div>	
						</div>
		<div class="col-md-4">
		<!--For Right Space-->
		</div>
	</div>
</div>
<p><br><br></p>
<!--Footer-->
<div class="navbar navbar-inverse navbar-fixed-bottom">
	
		<div class="container">
			<div style="padding-top:10px">
			 <p style="color:#ffffff; font-size:15px; text-align:center; "><span class="glyphicon glyphicon-copyright-mark" ></span> copyright TechApt
				<span class="glyphicon glyphicon-registration-mark"></span> 
			</p>
			</div>
		
	</div>
</div>
<!-- <footer class="navbar navbar-inverse container-fluid text-center">
 <p style="color:#ffffff; font-size:15px; text-align:center; "><span class="glyphicon glyphicon-copyright-mark" ></span> copyright TechApt
				<span class="glyphicon glyphicon-registration-mark"></span> 
			</p>
</footer> -->
	
	<script> src="js/jquery-3.1.0.min"</script>
	<script> src="js/bootstrap.js"</script>
	
  </body>
</html>