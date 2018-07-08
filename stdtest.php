<?php
error_reporting(0);
session_start();
include_once 'dbConnection.php';
if (!isset($_SESSION['stdname'])) {
     echo "<div class=\"alert alert-info\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
} else if (isset($_SESSION['starttime'])) {
    header('Location: testconductor.php');
}else if (isset($_REQUEST['starttest'])) {

  $result = executeQuery("select * from test where testid=" . $_REQUEST['starttest'] . " ;");
  $r = mysqli_fetch_array($result);
  $_SESSION['tname'] = $r['testname'];                        
  $_SESSION['tid'] = $r['testid'];  
	$result = executeQuery("select * from question where testid=" . $_SESSION['tid'] . " order by qnid;");
	if (mysqli_num_rows($result) == 0) {
    echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Tests questions cannot be selected.Please Try after some time!  </b></div>";
      
                   
                } else {
                
                    $error = false;
              
                    if (!executeQuery("insert into studenttest values(" . $_SESSION['stdid'] . "," . $_SESSION['tid'] . ",(select CURRENT_TIMESTAMP),date_add((select CURRENT_TIMESTAMP),INTERVAL (select duration from test where testid=" . $_SESSION['tid'] . ") MINUTE),0,'inprogress')"))
                        $_GLOBALS['message'] = "error" . mysqli_error();
                    else {
                        while ($r = mysqli_fetch_array($result)) {
                            if (!executeQuery("insert into studentquestion values(" . $_SESSION['stdid'] . "," . $_SESSION['tid'] . "," . $r['qnid'] . ",'unanswered',NULL)")) {
                                echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Failure while preparing questions for you.Try again </b></div>";

                                $error = true;
                            }
                        }
                        if ($error == true) {
                  
                        } else {
                            $result = executeQuery("select totalquestions,duration from test where testid=" . $_SESSION['tid'] . ";");
                            $r = mysqli_fetch_array($result);
                            $_SESSION['tqn'] = $r['totalquestions'];
                            $_SESSION['duration'] = $r['duration'];
                            $result = executeQuery("select DATE_FORMAT(starttime,'%Y-%m-%d %H:%i:%s') as startt,DATE_FORMAT(endtime,'%Y-%m-%d %H:%i:%s') as endt from studenttest where testid=" . $_SESSION['tid'] . " and stdid=" . $_SESSION['stdid'] . ";");
                            $r = mysqli_fetch_array($result);
                            $_SESSION['starttime'] = $r['startt'];
                            $_SESSION['endtime'] = $r['endt'];
                            $_SESSION['qn'] = 1;
                            header('Location: testconductor.php');
                        }
                    }
                }
    
}
?>
<title>Tests Offered</title>
<?php
include "header.php";
?>
<div class="container">
<?php
if ($_GLOBALS['message']) {
            echo "<div>" . $_GLOBALS['message'] . "</div>";
        }
if(isset($_SESSION['stdname'])){
		echo "<div class=\"alert alert-warning\" style=\"text-align:center;\"><h4>Offered Tests</h4></div>";
		$result = executeQuery("select t.*,s.name as nam from test as t, subject as s where s.subid=t.subid and t.subid=".$_GET['subid']." and t.totalquestions=(select count(*) from question where testid=t.testid) and NOT EXISTS(select stdid,testid from studenttest where testid=t.testid and stdid=" . $_SESSION['stdid'] . ");");
if (mysqli_num_rows($result) == 0) {

                                    echo"<h3 style=\"color:red;text-align:center;\">Sorry...! No Test Available.</h3>";
                                }
else
	{ ?>
		
		<form id="stdtest" action="stdtest.php" method="post">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<table class="table table-striped">
  			<tr><th>Test Name</th><th>Test Description</th><th>Subject Name</th><th>Duration</th><th>Total Questions</th><th>Take Test</th></tr>
  			
	<?php
		while ($r = mysqli_fetch_array($result)) {
                                      
                                        
            echo "<tr><td>" . $r['testname'] . "</td><td>" . $r['testdesc'] . "</td><td>". $r['nam']. "</td><td>" . $r['duration'] . "</td><td>" . $r['totalquestions'] . "</td>"
                  . "<td><button type=\"submit\" class=\"btn btn-success\" name=\"starttest\" value=\"".$r['testid']."\">Take Test</button></td></td></tr>";
                                    }
	}
	?>
	</table>
			</div>
			<div class="col-md-1"></div>
		</div>
		</form>
	</div>

	


<?php }
else{

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

<?php
include "footer.php";
?>