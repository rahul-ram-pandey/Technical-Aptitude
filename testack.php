<?php
error_reporting(0);
session_start();
include_once 'dbConnection.php';
if(!isset($_SESSION['stdname'])) {
     echo "<div class=\"alert alert-info\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
}
if(isset($_SESSION['starttime']))
{
    unset($_SESSION['starttime']);
    unset($_SESSION['endtime']);
    unset($_SESSION['tqn']);
    unset($_SESSION['qn']);
    unset($_SESSION['duration']);
    executeQuery("update studenttest set status='over' where testid=".$_SESSION['tid']." and stdid=".$_SESSION['stdid'].";");
}
?>
<title>Test Acknowledgement</title>
<?php
include "header.php";
?>

<?php
if(isset($_SESSION['stdname'])) {
?>


<div class="container">
          <h3 style="color:#0000cc;text-align:center;">Your answers are Successfully Submitted. To view the Results <b><a href="viewresult.php">Click Here</a></b> </h3>
          <?php
                        }
                        else
                          header('Location: index.php');

          ?>
      </div>




<?php
include "footer.php";
?>