<?php
error_reporting(0);
session_start();
include_once 'dbConnection.php';


        if(!isset($_SESSION['stdname'])){
            echo "<div class=\"alert alert-info\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
			 header('Location: index.php');
        }
        else if(isset($_REQUEST['logout'])){
                unset($_SESSION['stdname']);
            $_GLOBALS['message']="You are Loggged Out Successfully.";
           
        }
		else if(isset($_REQUEST['stdsubmit']))
        { 
				if(empty($_REQUEST['cname'])||empty ($_REQUEST['password'])||empty ($_REQUEST['email']))
				{
					 echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
             		 $_GLOBALS['message']="Some of the required Fields are Empty.Therefore Nothing is Updated </b></div>";
			
				}
				else
				{
					 $query="update student set stdname='".$_REQUEST['cname']."', stdpassword='".$_REQUEST['password']."',emailid='".$_REQUEST['email']."',contactno='".$_REQUEST['contactno']."',address='".$_REQUEST['address']."',city='".$_REQUEST['city']."',pincode='".$_REQUEST['pin']."' where stdid='".$_REQUEST['student']."';";
					 if(!@executeQuery($query))
						$_GLOBALS['message']=mysqli_error();
					 else
					 	 echo "<div class=\"alert alert-success\" role=\"alert\"><b>";
             		 $_GLOBALS['message']="Your Profile is Successfully Updated. </b></div>";
							}
				closedb();

		}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Update Profile</title>
    <link type="text/css" href="css/bootstrap.css" rel="stylesheet" />
	<link type="text/css" href="css/style.css" rel="stylesheet" />
	<script type="text/javascript" src="validate.js" ></script>
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


<div class="container">
	<div class="row">
		<div class="col-md-3">
		<!--For left Space-->
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
			 <div class="panel-heading"><b>Edit Profile</b></div>
			 <!--<div class="jumbotron text-center" style="margin-bottom:15px; padding:7px;" ><h3>Registration Form</h3></br></div> -->
				<div class="panel-body">
				<form class="form-horizontal" id="editprofile" action="editprofile.php" method="post" onsubmit="return validateform('editprofile');">
				 <?php
                       if(isset($_SESSION['stdname'])) {

                        $result=executeQuery("select stdid,stdname,stdpassword as stdpass ,emailid,contactno,address,city,pincode from student where stdname='".$_SESSION['stdname']."';");
                        if(mysqli_num_rows($result)==0) {
                           header('Location: stdwelcome.php');
                        }
                        else if($r=mysqli_fetch_array($result))
                        {
                           
                 ?>
				  <div class="form-group">
				   <label for="cname" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
					
					<input type="text" class="form-control" name="cname" value="<?php echo "".$r['stdname'].""; ?>" required />
					</div>
				  </div>
				  <div class="form-group">
				   <label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
					
					<input type="password" class="form-control" name="password" value="<?php echo "".$r['stdpass'].""; ?>" required/>
				  </div>
				</div>
				
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
					
					<input type="email" class="form-control" name="email" value="<?php echo "".$r['emailid'].""; ?>" required/>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="contactno" class="col-sm-2 control-label">Phone</label>
					<div class="col-sm-10">
					
					<input type="tel" class="form-control" name="contactno"  onkeyup="isnum(this)" value="<?php echo "".$r['contactno'].""; ?>" required/>
					</div>
				  </div>
				
				
					<div class="form-group">
					<label for="address" class="col-sm-2 control-label">Address</label>
					<div class="col-sm-10">
					
					 <textarea class="form-control resize" rows="3" name="address" required><?php echo "".$r['address'].""; ?></textarea>
					</div>
				  </div>
				  
				  
				   <div class="form-group">
					<label for="city" class="col-sm-2 control-label">City</label>
					<div class="col-sm-10">
					
					<input type="text" class="form-control" name="city"  onkeyup="isalpha(this)" value="<?php echo "".$r['city'].""; ?>" required/>
					</div>
				  </div>
				  
				   <div class="form-group">
					<label for="pin" class="col-sm-2 control-label">Pincode</label>
					<div class="col-sm-10">
					<input type="hidden" name="student" value="<?php echo "".$r['stdid'].""; ?>" />
					<input type="text" class="form-control" name="pin"  onkeyup="isnum(this)" value="<?php echo "".$r['pincode'].""; ?>" required/>
					</div>
				  </div>
				  
				   <div class="form-group">
				   <div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default black-background white" name="stdsubmit"><span class="glyphicon glyphicon-log-in"></span>  Update  </button>
						<button type="reset" class="btn btn-default black-background white" name="reset"><span class="glyphicon glyphicon-log-in"></span>  Reset  </button>
				   </div>
				   </div>
				   
				   <?php
				   closedb();
				   }
				   }
				   ?>
				</form>
				 
				
								</div>
							</div>	
						</div>
		<div class="col-md-3">
		<!--For Right Space-->
		</div>
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