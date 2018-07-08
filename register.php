
<?php
error_reporting(0);
session_start();
include_once 'dbConnection.php';

if(isset($_REQUEST['stdsubmit']))
{	
     $result=executeQuery("select max(stdid) as std from student");
     $r=mysqli_fetch_array($result);
     if(is_null($r['std']))
     $newstd=1;
     else
     $newstd=$r['std']+1;

     $result=executeQuery("select stdname as std from student where stdname='".$_REQUEST['cname']."';");

    // $_GLOBALS['message']=$newstd;
    if(empty($_REQUEST['cname'])||empty ($_REQUEST['password'])||empty ($_REQUEST['email']))
    {
    	  echo "<div class=\"alert alert-warning\" role=\"alert\"><b>";
              $_GLOBALS['message']="Some of the required Fields are Empty. </b></div>";
        
    }else if(mysqli_num_rows($result)>0)
    {
    	echo "<div class=\"alert alert-warning\" role=\"alert\"><b>";
              $_GLOBALS['message']="Sorry the User Name is Not Available Try with Some Other name. </b></div>";
    }
    else
    {
     $query="insert into student values($newstd,'".$_REQUEST['cname']."','".$_REQUEST['password']."','".$_REQUEST['email']."','".$_REQUEST['contactno']."','".$_REQUEST['address']."','".$_REQUEST['city']."','".$_REQUEST['pin']."')";
     if(!@executeQuery($query)){
     			if(mysqli_errno()==1062){
            	 echo "<div class=\"alert alert-warning\" role=\"alert\"><b>";
              		$_GLOBALS['message']= "This mail Id is already registered.<br>Try with different mail Id</b></div>";
              	}
              	else{
              		 echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              		$_GLOBALS['message']=mysqli_error() . "</b></div>";

              	}
              	}

     else
     {
        $success=true;
        echo "<div class=\"alert alert-success\" role=\"alert\"><b>";
              $_GLOBALS['message']="Successfully Your Account is Created.Click <a href=\"index.php\" class=\"alert-link\">Here</a> to LogIn. </b></div>";
       // header('Location: index.php');
     }
    }
    closedb();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Registration Page</title>
    <link type="text/css" href="css/bootstrap.css" rel="stylesheet" />
	<link type="text/css" href="css/style.css" rel="stylesheet" />
	<script type="text/javascript" src="validate.js" ></script>
  </head>
  <body background="images/back/5.png">
<?php

        if($_GLOBALS['message']) {
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
	    <li class="active"><a href="stdwelcome.php">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="feedback.php">Feedback</a></li> 
      </ul>
    <ul class="nav navbar-nav navbar-right">
      
      <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>

  </div>
</nav>
<!--end of header-->

   <?php
          if($success)
          {
     ?>
     <p><br><br><br></p>
     <div class="container">
     <div class="bs-callout bs-callout-success">
		  <h4>Thank You For Registering with TechApt.</h4>
		  <a href="index.php">Login Now</a>
	 </div>
     </div>          
       <?php   }
          else
          {
          
          ?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
		<!--For left Space-->
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			 <div class="panel-heading"><b>Registration Form</b></div>
			 <!--<div class="jumbotron text-center" style="margin-bottom:15px; padding:7px;" ><h3>Registration Form</h3></br></div> -->
				<div class="panel-body">
				<form id="admloginform" action="register.php" method="post" onsubmit="return validateform('admloginform');">
				
				  <div class="form-group">
					<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
					<input type="text" class="form-control" name="cname" placeholder="Username" required />
					</div>
				  </div>
				  <div class="form-group">
				  <div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></div>
					<input type="password" class="form-control" name="password" placeholder="Password" required/>
				  </div>
				</div>
				
				<div class="form-group">
				  <div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></div>
					<input type="password" class="form-control" name="repass" placeholder="Confirm Password" required />
				  </div>
				</div>
				
				<div class="form-group">
					<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
					<input type="email" class="form-control" name="email" placeholder="E-mail" required/>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></div>
					<input type="tel" class="form-control" name="contactno" placeholder="Phone No." onkeyup="isnum(this)" required/>
					</div>
				  </div>
				
				
					<div class="form-group">
					<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
					 <textarea class="form-control resize" rows="3" name="address" placeholder="Address" required></textarea>
					</div>
				  </div>
				  
				  
				   <div class="form-group">
					<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
					<input type="text" class="form-control" name="city" placeholder="City" onkeyup="isalpha(this)" required/>
					</div>
				  </div>
				  
				   <div class="form-group">
					<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-screenshot"></span></div>
					<input type="text" class="form-control" name="pin" placeholder="Pincode" onkeyup="isnum(this)" required/>
					</div>
				  </div>
				  
				  <button type="submit" class="btn btn-default black-background white" name="stdsubmit"><span class="glyphicon glyphicon-log-in"></span>  Register  </button>
				  <button type="reset" class="btn btn-default black-background white" name="reset"><span class="glyphicon glyphicon-log-in"></span>  Reset  </button>
				
				
				</form>
				 
				
								</div>
							</div>	
						</div>
		<div class="col-md-4">
		<!--For Right Space-->
		</div>
	</div>
</div>
<?php } ?>
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