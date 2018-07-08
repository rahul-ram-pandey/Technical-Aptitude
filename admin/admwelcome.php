<?php
error_reporting(0);
session_start();
 if(!isset($_SESSION['admname'])){
            echo "<div class=\"alert alert-info\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
        }
        else if(isset($_REQUEST['logout'])){
            unset($_SESSION['admname']);
            echo "<div class=\"alert alert-info\" role=\"success\"><b>";
              $_GLOBALS['message']="You are logged out successfully!!";
            header('Location: index.php');
        }
?>


<?php
	include "header.php";
?>

<title>Admin Homepage</title>
<?php
if(!isset($_SESSION['admname'])){
header('Location: index.php');
}
 ?>
<div class="row">
	<div class="col-md-3">
	
	</div>
	
	<div class="col-md-6">
			<div class="row">
			
			
			<div class="well col-md-5">
			<h4>Add Subjects</h4>
			<a href="subject.php"><img src="../images/subjects.jpeg" class="img-responsive img-thumbnail" /></a>
			</div>
			<div class="col-md-2"></div>
			<div class="well col-md-5">
			<h4>Add Tests</h4>
			<a href="testmng.php"><img src="../images/mamage_tests.jpg" class="img-responsive img-thumbnail" /></a>
			</div>
		</div>

		<div class="row">
			<div class="well col-md-5">
			<h4>Add Questions</h4>
			<a href="testmng.php?forpq=true"><img src="../images/mamage_questions.jpg" class="img-responsive img-thumbnail" /></a>
			</div>
			<div class="col-md-2"></div>
			<div class="well col-md-5">
			<h4>Manage Users</h4>
			<a href="usermng.php"><img src="../images/mamage_users.png" class="img-responsive img-thumbnail" /></a>
			
			</div>
			
		</div>
		<div class="row">
			<div class="well col-md-5">
			<h4>Manage Results</h4>
			<a href="resultadm.php"><img src="../images/manage_results.jpg" class="img-responsive img-thumbnail" /></a>
			<div class="col-md-7"></div>
			</div>
		</div>
	</div>
	
	<div class="col-md-3">
	
	</div>
</div>

<?php
	include "footer.php";
?>