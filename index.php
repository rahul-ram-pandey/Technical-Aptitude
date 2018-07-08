
 <?php
 
      error_reporting(1);
      session_start();
      include_once 'dbConnection.php';

 
      if(isset($_REQUEST['stdsubmit']))
      {
          $result=executeQuery("select *,stdpassword as std from student where stdname='".$_REQUEST['name']."' and stdpassword='".$_REQUEST['password']."';");
		  echo $result;
          if(mysqli_num_rows($result)>0)
          {
				
              $r=mysqli_fetch_array($result);
              if(strcmp($r['std'],$_REQUEST['password'])==0)
              {
                  $_SESSION['stdname']=$r['stdname'];
                  $_SESSION['stdid']=$r['stdid'];
                  unset($_GLOBALS['message']);
                  header('Location: stdwelcome.php');
              }else
          {
		 	  echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Check Your user name and Password. </b></div>";
          }

          }
          else
          {
		 	  echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="No Credentials found. </b></div>";
          }
          closedb();
      }
	  else if($_REQUEST['f']==1){
		  
		   echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Kindly Login to give feedback. </b></div>";
	  }
	 
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Index Page</title>
    <link type="text/css" href="css/bootstrap.css" rel="stylesheet" />
	<link type="text/css" href="css/style.css" rel="stylesheet" />
	
  </head>
  <body background="images/back/1.png">
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
      <ul class="nav navbar-nav navbar-right">
	    <li class="active"><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="feedback.php">Feedback</a></li> 
      </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
    </ul>

  </div>
</nav>
<?php if(isset($_SESSION['stdname'])){
                         header('Location: stdwelcome.php');} 
                        ?>
<p><br><br><br><br><br><br></p>
<form id="stdloginform" action="index.php" method="post">
<div class="container">
	<div class="row">
		<div class="col-md-4">
		
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel-heading"><b>Login</b></div>
				<div class="panel-body">
				<!--<div class="jumbotron text-center" style="margin-bottom:15px; padding:7px;"><h3>Login Form</h3></br></div>-->
				
				
				  <div class="form-group">
					<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
					<input type="text" class="form-control" name="name" placeholder="Username" required />
					</div>
				  </div>
				  <div class="form-group">
				  <div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></div>
					<input type="password" class="form-control" name="password" placeholder="Password" required />
					
				 </div>
				</div>
				
				  <button type="submit" name="stdsubmit" class="btn btn-default  btn-block black-background white "><span class="glyphicon glyphicon-log-in"></span>  Submit  </button>
				  <a href="forgot1.php" class="black"><p class="cent">Forgot Password?</p></a>
				</form>
				
								</div>
							</div>	
						</div>
		<div class="col-md-4">
	
		</div>
	</div>
</div>

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