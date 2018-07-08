<?php
error_reporting(0);
session_start();
include_once '../dbConnection.php';

if (!isset($_SESSION['admname'])) {
   $_GLOBALS['message'] = "Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}
else if(isset($_REQUEST['back'])) {
   header('Location: resultadm.php');
}
?>

<?php
include "header.php";
?>
<form name="resultadm" action="resultadm.php" method="post">
 <div class="container">

 <div class="row">
 <div class="col-md-1">
 </div>
 <div class="col-md-10">
 <div class="alert alert-warning" style="text-align:center;"><h4>Test Summary</h4></div>
                        <?php
                        if(isset($_REQUEST['testid'])) {

                            $result=executeQuery("select t.testname,sub.name,IFNULL((select sum(marks) from question where testid=".$_REQUEST['testid']."),0) as maxmarks from test as t, subject as sub where sub.subid=t.subid and t.testid=".$_REQUEST['testid'].";") ;
                            if(mysqli_num_rows($result)!=0) {

                                $r=mysqli_fetch_array($result);
                                ?>
                    <table class="table table-striped">
                        
                        <tr>
                            <th>Test Name</th>
                            <td><?php echo $r['testname']; ?></td>
                        </tr>
                        <tr>
                            <th>Subject Name</th>
                            <td><?php echo $r['name']; ?></td>
                        </tr>
                      
                        <tr>
                            <th>Max. Marks</th>
                            <td><?php echo $r['maxmarks']; ?></td>
                        </tr>
                  
                        <tr>
						
                            <td colspan="2">
							<div class="alert alert-warning" style="text-align:center;"><h4>Attempted Students</h4></div>
							</td>
                        </tr>

                    </table>
                                <?php

                                 $result1=executeQuery("select s.stdname,s.emailid,(select sum(q.marks) as om from studentquestion as sq, question as q where sq.testid=q.testid and sq.qnid=q.qnid and sq.answered='answered' and sq.stdanswer=q.correctanswer and sq.stdid=st.stdid and sq.testid=".$_REQUEST['testid'].") as om from studenttest as st, student as s where s.stdid=st.stdid and st.testid=".$_REQUEST['testid'].";" );
                                if(mysqli_num_rows($result1)==0) {
                                    
									?>
									<div class="bs-callout bs-callout-danger">
                                  <h4 style="text-align:center;">No Students Yet Attempted this Test!</h4>
                               </div>
									<?php
                                }
                                else {
                                    ?>
                    <table class="table table-striped">
                        <tr>
                            <th>Student Name</th>
                            <th>Email-ID</th>
                            <th>Obtained Marks</th>
                            <th>Result(%)</th>

                        </tr>
                                        <?php
                                        while($r1=mysqli_fetch_array($result1)) {

                                            ?>
                        <tr>
                            <td><?php echo $r1['stdname']; ?></td>
                            <td><?php echo $r1['emailid']; ?></td>
                            <td><?php echo $r1['om']; ?></td>
                            <td><?php echo ($r1['om']/$r['maxmarks']*100)." %"; ?></td>


                        </tr>
                                        <?php
                                        
                                        }

                                    }
                                }
                                else {
                                    echo"<h3 style=\"color:#0000cc;text-align:center;\">Something went wrong. Please logout and Try again.</h3>";
                                }
                                ?>
                    </table>


                        <?php

                        }
                        else {

                            $result=executeQuery("select t.testid,t.testname,sub.name,(select count(stdid) from studenttest where testid=t.testid) as attemptedstudents from test as t, subject as sub where sub.subid=t.subid;");
                            if(mysqli_num_rows($result)==0) {
                                echo "<h3 style=\"color:#0000cc;text-align:center;\">No Tests Yet...!</h3>";
                            }
                            else {
                                echo "";

                                ?>
                    <table class="table table-striped">
					
                        <tr>
                            <th>Test Name</th>
                            <th>Subject Name</th>
                            <th>Attempted Students</th>
                            <th>Details</th>
                        </tr>
            <?php
                                    while($r=mysqli_fetch_array($result)) {
                                        $i=$i+1;
                                        if($i%2==0) {
                                            echo "<tr class=\"alt\">";
                                        }
                                        else { echo "<tr>";}
                                        echo "<td>".htmlspecialchars_decode($r['testname'],ENT_QUOTES)."</td>"
                                            ."<td>".htmlspecialchars_decode($r['name'],ENT_QUOTES)."</td><td>".$r['attemptedstudents']."</td>"
                                            ."<td class=\"tddata\"><a title=\"Details\" href=\"resultadm.php?testid=".$r['testid']."\">Details</a></td></tr>";
                                    }
                                    ?>
                    </table>
        <?php
                            }
                        }
                        closedb();
                    

                    ?>

		</div>			
					<div class="col-md-1">
 </div>
 </div>
                </div>


</form>

<?php
include "footer.php";
?>