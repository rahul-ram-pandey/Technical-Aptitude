<?php
error_reporting(0);
session_start();
include_once 'dbConnection.php';
if(!isset($_SESSION['stdname'])) {
    echo "<div class=\"alert alert-info\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
}
    else if(isset($_REQUEST['change']))
    {
       
       $_SESSION['qn']=substr($_REQUEST['change'],7);
       header('Location: testconductor.php');

    }
    else if(isset($_REQUEST['finalsubmit'])){

     header('Location: testack.php');

    }
     else if(isset($_REQUEST['fs'])){
  
     header('Location: testack.php');

    }

?>
<title>Test Summary</title>
 <script type="text/javascript" src="cdtimer.js" ></script>
    <script type="text/javascript" >
   
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
                     $_GLOBALS['min'] = $rslt['min'];
                    }
                    else
                    {
                       echo "<div class=\"alert alert-danger\" role=\"alert\"><b>".$_GLOBALS['message']="Try Again. </b></div>";;
              
                      
                    }
                    closedb();
                }
                else
                {
                    echo "var sec=01;var min=00;var hour=00;";
                }
        ?>

    </script>


<?php
include "header.php";
?>
<div class="container">
 <form id="summary" action="summary.php" method="post">
 <?php if(isset($_SESSION['stdname'])) {
  echo "<div class=\"alert alert-warning\" style=\"text-align:center;\"><h4>Test Summary</h4></div>";
 ?>

<div><h3><span id="timer" class="timerclass" 

                      style="<?php if($_GLOBALS['min']<1) { echo "color:red";} else {echo "color:green";} ?>"></span>
                      </h3></div>
                 
          <?php

                        $result=executeQuery("select * from studentquestion where testid=".$_SESSION['tid']." and stdid=".$_SESSION['stdid']." order by qnid ;");
                        if(mysqli_num_rows($result)==0) { ?>
                        <div class="bs-callout bs-callout-danger">
                        <h4>Something went wrong please logout and try again.</h4>
                        <a href="logout.php" class="alert-link">Logout Now</a>
                        </div>
   <?php
                         
                        }
                        else
                        {
                       
          ?>
          <table  class="table table-hover">
                        <tr>
                            <th>Question No</th>
                            <th>Status</th>
                            <th>Change Your Answer</th>
                       </tr>
        <?php
                        while($r=mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>".$r['qnid']."</td>";
                                    if(strcmp($r['answered'],"unanswered")==0 ||strcmp($r['answered'],"review")==0)
                                    {
                                        echo "<td style=\"color:#ff0000\">".$r['answered']."</td>";
                                    }
                                    else
                                    {
                                        echo "<td style=\"color:green\">".$r['answered']."</td>";
                                    }
                                    echo"<td><input type=\"submit\" value=\"Change ".$r['qnid']."\" name=\"change\" class=\"btn btn-danger\" /></td></tr>";
                                }

                                ?>
              <tr>
                  <td colspan="3" style="text-align:center;"><input type="submit" name="finalsubmit" value="Final Submit" class="btn btn-success"/></td>
              </tr>
                    </table>

      </div>


<?php }
closedb();
}else{

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


</form>
<?php
include "footer.php";
?>