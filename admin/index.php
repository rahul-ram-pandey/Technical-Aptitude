<?php
      error_reporting(0);
      session_start();
      include_once '../dbConnection.php';

      if(isset($_REQUEST['admsubmit']))
      {
        
          $result=executeQuery("select * from adminlogin where admname='".$_REQUEST['name']."' and admpassword='".$_REQUEST['password']."';");
			
          if(mysqli_num_rows($result)>0)
          {
              
              $r=mysqli_fetch_array($result);
              if(strcmp($r['admpassword'],$_REQUEST['password'])==0)
              {
                  $_SESSION['admname']=$r['admname'];
                  unset($_GLOBALS['message']);
                  header('Location: admwelcome.php');
              }else
          {
             echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Check Your user name and Password. </b></div>";
                 
          }

          }
          else
          {
              echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Check Your user name and Password. </b></div>";
              
          }
          closedb();
      }
 ?>
<title>Admin Login</title>
<!--header-->
<?php
	include "header.php";
?>

<!--body section-->
<?php if(isset($_SESSION['admname'])){
                         header('Location: admwelcome.php');} 
                        ?>
<p><br><br><br><br><br><br></p>
<form name="admwelcome" action="index.php" method="post">
<div class="container">
	<div class="row">
		<div class="col-md-4">
		
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel-heading"><b>Admin Login</b></div>
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
				
				
				  <button type="submit" name="admsubmit" class="btn btn-default  btn-block black-background white "><span class="glyphicon glyphicon-log-in"></span>  Submit  </button>
				  
				</form>
				
								</div>
							</div>	
						</div>
		<div class="col-md-4">
	
		</div>
	</div>
</div>

<!--footer-->
<?php
	include "footer.php";
?>
</html>