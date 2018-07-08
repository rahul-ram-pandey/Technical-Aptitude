<?php
error_reporting(0);
session_start();
include_once 'dbConnection.php';

if(!isset($_SESSION['stdname'])) {
     echo "<div class=\"alert alert-info\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
}
?>

<?php
include "header.php";
?>
<?php
if(isset($_SESSION['stdname'])){

?>
<title>View Results</title>
<form id="viewresult" action="viewresult.php" method="post">
	<div class="container">

                        <?php

                        if(isset($_REQUEST['details'])) {
                            $result=executeQuery("select s.stdname,t.testname,sub.name,DATE_FORMAT(st.starttime,'%d %M %Y %H:%i:%s') as stime,TIMEDIFF(st.endtime,st.starttime) as dur,(select sum(marks) from question where testid=".$_REQUEST['details'].") as tm,IFNULL((select sum(q.marks) from studentquestion as sq, question as q where sq.testid=q.testid and sq.qnid=q.qnid and sq.answered='answered' and sq.stdanswer=q.correctanswer and sq.stdid=".$_SESSION['stdid']." and sq.testid=".$_REQUEST['details']."),0) as om from student as s,test as t, subject as sub,studenttest as st where s.stdid=st.stdid and st.testid=t.testid and t.subid=sub.subid and st.stdid=".$_SESSION['stdid']." and st.testid=".$_REQUEST['details'].";") ;
                            if(mysqli_num_rows($result)!=0) {

                                $r=mysqli_fetch_array($result);
                                ?>
                    <table class="table table-striped">
                        <tr class="warning">
                            <td colspan="2"><h3 style="text-align:center;">Test Summary</h3></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="color:#ff0000;border-width:4px;"/></td>
                        </tr>
                        <tr>
                            <th>Student Name</th>
                            <td><?php echo $r['stdname']; ?></td>
                        </tr>
                        <tr>
                            <th>Test</th>
                            <td><?php echo $r['testname']; ?></td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td><?php echo $r['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Date and Time</th>
                            <td><?php echo $r['stime']; ?></td>
                        </tr>
                        <tr>
                            <th>Test Duration</th>
                            <td><?php echo $r['dur']; ?></td>
                        </tr>
                        <tr>
                            <th>Max. Marks</th>
                            <td><?php echo $r['tm']; ?></td>
                        </tr>
                        <tr>
                            <th>Obtained Marks</th>
                            <td><?php echo $r['om']; ?></td>
                        </tr>
                        <tr>
                            <th>Percentage</th>
                            <td><?php echo (($r['om']/$r['tm'])*100)." %"; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="color:#ff0000;border-width:2px;"/></td>
                        </tr>
                         <tr class="warning">
                            <td colspan="2"><h3 style="text-align:center;">Test Information in Detail</h3></td>
                        </tr>
                        <tr>
                            <td colspan="2" ><hr style="color:#ff0000;border-width:4px;"/></td>
                        </tr>
                    </table>
                                <?php

                                $result1=executeQuery("select q.qnid as questionid,q.question as quest,q.correctanswer as ca,sq.answered as status,sq.stdanswer as sa from studentquestion as sq,question as q where q.qnid=sq.qnid and sq.testid=q.testid and sq.testid=".$_REQUEST['details']." and sq.stdid=".$_SESSION['stdid']." order by q.qnid;" );

                                if(mysqli_num_rows($result1)==0) {
                                    ?>
                                    <div class="bs-callout bs-callout-danger">
                                      <h4>Sorry because of some problems Individual questions Cannot be displayed.</h4> 
                                     </div>
                                    <?php
                                }
                                else {
                                    ?>
                    <table class="table table-striped">
                        
                        <tr>
                            <th>Q. No</th>
                            <th>Question</th>
                            <th>Correct Answer</th>
                            <th>Your Answer</th>
                            <th>Score</th>
                            
                        </tr>
                                        <?php
                                        while($r1=mysqli_fetch_array($result1)) {

                                        if(is_null($r1['sa']))
                                        $r1['sa']="question"; //any valid field of question
                                           $result2=executeQuery("select ".$r1['ca']." as corans,IF('".$r1['status']."'='answered',(select ".$r1['sa']." from question where qnid=".$r1['questionid']." and testid=".$_REQUEST['details']."),'unanswered') as stdans, IF('".$r1['status']."'='answered',IFNULL((select q.marks from question as q, studentquestion as sq where q.qnid=sq.qnid and q.testid=sq.testid and q.correctanswer=sq.stdanswer and sq.stdid=".$_SESSION['stdid']." and q.qnid=".$r1['questionid']." and q.testid=".$_REQUEST['details']."),0),0) as stdmarks from question where qnid=".$r1['questionid']." and testid=".$_REQUEST['details'].";");

                                            if($r2=mysqli_fetch_array($result2)) {
                                                 if($r2['stdmarks']==0) {
                                                    echo "<tr class=\"danger\">";
                                                 }
                                                 else
                                                    echo "<tr class=\"success\">";
                                                ?>
                       
                            <td><?php echo $r1['questionid']; ?></td>
                            <td><?php echo $r1['quest']; ?></td>
                            <td><?php echo $r2['corans']; ?></td>
                            <td><?php echo $r2['stdans']; ?></td>
                            <td><?php echo $r2['stdmarks']; ?></td>
                                                
                        </tr>
                            <?php
                                                }
                                                else {
                                                    ?>
                                                    <div class="bs-callout bs-callout-danger">
                                  <h4>Sorry because of some problems Individual questions Cannot be displayed.<?php echo mysqli_error(); ?></h4>
                               </div>
                                                    <?php
                                                }
                                            }

                                        }
                                    }
                                    else {
                                        ?>
                                        <div class="bs-callout bs-callout-danger">
                                  <h4>Something went wrong. Please logout and Try again.<?php echo mysqli_error(); ?></h4>
                               </div>
                                        <?php
                                    }
                                    ?>
                    </table>
                                <?php

                        }
                        else {


                            $result=executeQuery("select st.*,t.testname,t.testdesc,DATE_FORMAT(st.starttime,'%d %M %Y %H:%i:%s') as startt from studenttest as st,test as t where t.testid=st.testid and st.stdid=".$_SESSION['stdid']." and st.status='over' order by st.testid;");
                            if(mysqli_num_rows($result)==0) {
                                ?>
                                <div class="bs-callout bs-callout-danger">
                                  <h4>I Think You Haven't Attempted Any Exams Yet..! Please Try Again After Your Attempt.</h4>
                               </div>
                                <?php
                            }
                            else {
                            //editing components
                                ?>
                    <table class="table table-striped">
                        <tr class="warning">
                            <td colspan="6"><h3 style="text-align:center;">Test Summary</h3></td>
                        </tr>
                        <tr>
                            <th>Date and Time</th>
                            <th>Test Name</th>
                            <th>Max. Marks</th>
                            <th>Obtained Marks</th>
                            <th>Percentage</th>
                            <th>Details</th>
                        </tr>
            <?php
            while($r=mysqli_fetch_array($result)) {
                                       
                                        $om=0;
                                        $tm=0;
                                        $result1=executeQuery("select sum(q.marks) as om from studentquestion as sq, question as q where sq.testid=q.testid and sq.qnid=q.qnid and sq.answered='answered' and sq.stdanswer=q.correctanswer and sq.stdid=".$_SESSION['stdid']." and sq.testid=".$r['testid']." order by sq.testid;");
                                        $r1=mysqli_fetch_array($result1);
                                        $result2=executeQuery("select sum(marks) as tm from question where testid=".$r['testid'].";");
                                        $r2=mysqli_fetch_array($result2);
                                        
                                        echo "<tr>";
                                        echo "<td>".$r['startt']."</td><td>".$r['testname']." : ".$r['testdesc']."</td>";
                                        if(is_null($r2['tm'])) {
                                            $tm=0;
                                            echo "<td>$tm</td>";
                                        }
                                        else {
                                            $tm=$r2['tm'];
                                            echo "<td>$tm</td>";
                                        }
                                        if(is_null($r1['om'])) {
                                            $om=0;
                                            echo "<td>$om</td>";
                                        }
                                        else {
                                            $om=$r1['om'];
                                            echo "<td>$om</td>";
                                        }
                                        if($tm==0) {
                                            echo "<td>0</td>";
                                        }
                                        else {
                                            echo "<td>".(($om/$tm)*100)." %</td>";
                                        }
                                        echo"<td class=\"\"><a title=\"Details\" href=\"viewresult.php?details=".$r['testid']."\">View Details</a></td></tr>";
                                    }

                                    ?>

                    </table>
        <?php
        }
                        }
                        closedb();
                    
                    ?>
                    
                </div>

</form>
<p><br><br><br></p>

<?php
}
else
{
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