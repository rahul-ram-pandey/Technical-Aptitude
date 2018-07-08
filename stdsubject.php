<?php
error_reporting(0);
session_start();
include_once 'dbConnection.php';
if(!isset($_SESSION['stdname'])) {
     echo "<div class=\"alert alert-info\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
              }
?>
<title>Subjects</title>

<?php
include "header.php";
?>

	    		
				<?php
				if(isset($_SESSION['stdname'])) {
				$result = executeQuery("select * from subject");
				?>
				<div class="container-fluid">
				<div class="row">
					<div class="col-md-2">
				    </div>
				    <div class="col-md-8">
				<div class="row">
				<div class="col-md-12">
				<?php
				while($row=mysqli_fetch_array($result)){
						$courses_taken=$row['subid'];
						echo "<div class=col-md-3>";
						echo "<div class=well>";?> <a href="stdtest.php?subid=<?php echo $courses_taken; ?>"><img src="<?php echo "images/sub/".$row['image']?>" class="img-rounded" height="150" width="150"> </a> <?php echo "</div>";
						echo "</div>";
						echo "<div class=col-md-1></div>";
				}
				?>
				</div>
				</div>
				
		</div>
		<div class="col-md-2">
	    </div>
	</div>
</div>

<?php
}
else {
?>

<div class="container">
     <div class="bs-callout bs-callout-primary">
      <h4>Session Timed out.</h4>
      <a href="index.php" class="alert-link">Login Now</a>
   </div>
</div>

<?php
}
?>

<p><br><br><br></p>
<?php
include "footer.php";
?>