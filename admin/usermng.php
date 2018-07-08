<?php
error_reporting(0);
session_start();
include_once '../dbConnection.php';
$sid = 1;
$sid = $_REQUEST['student'];
$result=executeQuery("select max(stdid) as std from student");
    $r=mysqli_fetch_array($result);
    $maxid = $r['std'];


if(isset($_REQUEST['first']))
{
	unset($_GLOBALS['message']);
	$sid = 1;
}

	if(isset($_REQUEST['next']))
{
	if($sid<$maxid){
		unset($_GLOBALS['message']);
		unset($_GLOBALS['message']);
	$sid++;
}
else{

	 echo "<div class=\"alert alert-info\" role=\"alert\"><b>";
              $_GLOBALS['message']="No records to be fetched. </b></div>";
}
}
else if(isset($_REQUEST['previous']))
{
	if($sid>1){
		unset($_GLOBALS['message']);
	$sid--;
}
else{

	 echo "<div class=\"alert alert-info\" role=\"alert\"><b>";
              $_GLOBALS['message']="No records to be fetched. </b></div>";
}
}
else if(isset($_REQUEST['last']))
{
	$result=executeQuery("select max(stdid) as std from student");
    $r=mysqli_fetch_array($result);
    $sid = $r['std'];
}



?>

<?php
include "header.php";
?>
<title>Student Maanagement</title>

<div class="container">
	<div class="row">
		<div class="col-md-3">
		<!--For left Space-->
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
			 <div class="panel-heading"><b>Student Database</b></div>
			 
				<div class="panel-body">
				<form class="form-horizontal" id="usermng" action="usermng.php" method="post">
				
				 <?php
                       
                        $result=executeQuery("select stdid,stdname,stdpassword as stdpass ,emailid,contactno,address,city,pincode from student where stdid='".$sid."';");

                        $r=mysqli_fetch_array($result);
                        if(mysqli_num_rows($result)==0) {
                          echo "<div class=\"alert alert-primary\" role=\"alert\"><b>";
              $_GLOBALS['message']="No records to be fetched. </b></div>";
                        }
                        
                           
                 ?>

				  <div class="form-group">
				   <label for="cname" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
					
					<input type="text" class="form-control" name="cname" value="<?php echo "".$r['stdname'].""; ?>" readonly />
					</div>
				  </div>
				  <div class="form-group">
				   <label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
					
					<input type="text" class="form-control" name="password" value="<?php echo "".$r['stdpass'].""; ?>" readonly />
				  </div>
				</div>
				
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
					
					<input type="text" class="form-control" name="email" value="<?php echo "".$r['emailid'].""; ?>" required readonly />
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="contactno" class="col-sm-2 control-label">Phone</label>
					<div class="col-sm-10">
					
					<input type="tel" class="form-control" name="contactno" value="<?php echo "".$r['contactno'].""; ?>" readonly />
					</div>
				  </div>
				
				
					<div class="form-group">
					<label for="address" class="col-sm-2 control-label">Address</label>
					<div class="col-sm-10">
					
					 <textarea class="form-control resize" rows="3" name="address" readonly><?php echo "".$r['address'].""; ?></textarea>
					</div>
				  </div>
				  
				  
				   <div class="form-group">
					<label for="city" class="col-sm-2 control-label">City</label>
					<div class="col-sm-10">
					
					<input type="text" class="form-control" name="city" value="<?php echo "".$r['city'].""; ?>" readonly />
					</div>
				  </div>
				  
				   <div class="form-group">
					<label for="pin" class="col-sm-2 control-label">Pincode</label>
					<div class="col-sm-10">
					<input type="hidden" name="student" value="<?php echo "".$r['stdid'].""; ?>" />
					<input type="text" class="form-control" name="pin" value="<?php echo "".$r['pincode'].""; ?>" readonly/>
					</div>
				  </div>
				  <div class="form-group">
				   <div class="col-sm-offset-2 col-sm-10">
				   		<button type="submit" class="btn btn-default black-background white" name="first">  First  </button>
						<button type="submit" class="btn btn-default black-background white" name="next">  Next  </button>
						<button type="submit" class="btn btn-default black-background white" name="previous">  Previous  </button>
						<button type="submit" class="btn btn-default black-background white" name="last">  Last  </button>
				   </div>
				   </div>
				   
				   <?php
				   closedb();
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

<?php
include "footer.php";
?>