<?php
error_reporting(0);
session_start();
include_once 'dbConnection.php';

if(!isset($_SESSION['stdname'])) {
    echo "<div class=\"alert alert-info\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
}

            else if(isset($_REQUEST['resumetest'])) {
            	if($r=mysqli_fetch_array($result=executeQuery("select testname from test where testid=".$_REQUEST['resumetest'].";"))) {
                    $_SESSION['tname']=$r['testname'];
                    $_SESSION['tid']=$_REQUEST['resumetest'];

                $result=executeQuery("select totalquestions,duration from test where testid=".$_SESSION['tid'].";");
                                $r=mysqli_fetch_array($result);
                                $_SESSION['tqn']=$r['totalquestions'];
                                $_SESSION['duration']=$r['duration'];
                                $result=executeQuery("select DATE_FORMAT(starttime,'%Y-%m-%d %H:%i:%s') as startt,DATE_FORMAT(endtime,'%Y-%m-%d %H:%i:%s') as endt from studenttest where testid=".$_SESSION['tid']." and stdid=".$_SESSION['stdid'].";");
                                $r=mysqli_fetch_array($result);
                                $_SESSION['starttime']=$r['startt'];
                                $_SESSION['endtime']=$r['endt'];
                                $_SESSION['qn']=1;
                                header('Location: testconductor.php');
                }
            }
   else if(isset($_REQUEST['fs']))
    {
    	executeQuery("update studenttest set status='over' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['tid'].";");
        header('Location: resumetest.php');
    }
?>
<title>Resume</title>
<?php
include "header.php";
?>
<script type="text/javascript" src="cdtimer.js" ></script>
<script type="text/javascript" >
    <!--
        <?php
                $elapsed=time()-strtotime($_SESSION['starttime']);
                if(((int)$elapsed/60)<(int)$_SESSION['duration'])
                {
                    $result=executeQuery("select TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%H') as hour,TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%i') as min,TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%s') as sec from studenttest where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['tid'].";");
                    if($rslt=mysqli_fetch_array($result))
                    {
                     echo "var hour=".$rslt['hour'].";";
                     echo "var min=".$rslt['min'].";";
                     echo "var sec=".$rslt['sec'].";";
                    }
                    else
                    {
                        $_GLOBALS['message']="Try Again";
                    }
                    closedb();
                }
                else
                {
                    echo "var sec=01;var min=00;var hour=00;";
                }
        ?>
        
    -->
    </script>
    <div class="container">
<form id="resumetest" action="resumetest.php" method="post">
<?php if(isset($_SESSION['stdname'])) {
	echo "<div class=\"alert alert-warning\" style=\"text-align:center;\"><h4>Tests to be resumed</h4></div>";

	$result=executeQuery("select t.testid,t.testname,DATE_FORMAT(st.starttime,'%d %M %Y %H:%i:%s') as startt,sub.name as sname,TIMEDIFF(st.endtime,CURRENT_TIMESTAMP) as remainingtime from subject as sub,studenttest as st,test as t where sub.subid=t.subid and t.testid=st.testid and st.stdid=".$_SESSION['stdid']." and st.status='inprogress' order by st.starttime desc;");
	
	if(mysqli_num_rows($result)==0) {
            echo"<h3 style=\"color:#0000cc;text-align:center;\"> No incomplete tests! Please Try Again..!</h3>";
        }
    else {   

?>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
			<table class="table table-striped">
  			<tr><th>Test</th><th>Subject Name</th><th>Remaining Time</th><th>Resume</th></tr>
  			
	<?php
		
		while ($r = mysqli_fetch_array($result)) {

            echo "<tr><td>" . $r['testname'] . "</td><td>" . $r['sname'] . "</td><td><span id=\"timer\" class=\"timerclass\" style=\"color:red\"></span></td><td><button type=\"submit\" class=\"btn btn-danger\" name=\"resumetest\" value=\"".$r['testid']."\">Take Test</button></td></td></tr>";
                                    }
	


	?>
	</table>
			</div>
			<div class="col-md-1"></div>
		</div>
		</form>
	</div>



<?php

}
}

?>

<?php
include "footer.php";
?>