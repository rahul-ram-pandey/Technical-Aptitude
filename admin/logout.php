<?php
      error_reporting(0);
	  session_start();
	   unset($_SESSION['admname']);
             echo "<div class=\"alert alert-success\" role=\"alert\"><b>";
              $_GLOBALS['message']="You are Loggged Out Successfully. Click <a href=\"index.php\" class=\"alert-link\">Here</a> to LogIn </b></div>";
      session_destroy();
	  if(!isset($_SESSION['adnname']))
	  {
	  $logout=true;
      }
	  else
	  {
	  $logout = false;
	  }
 ?>


<?php
	include "header.php";
?>

<p><br><br><br><br></p>
<?php
		if($logout) 
		{
                
          ?>
		   <div class="container">
     <div class="bs-callout bs-callout-success">
     <center> <h4>Logged out successfully.</h4>
      <a href="index.php" class="alert-link">Login Now</a></center>
   </div>
     </div> 
		  
		  
		  
		  <?php
		  }
          
          
?>

<?php
	include "footer.php";
?>