<?php
	error_reporting(0);
	session_start();
	include_once 'dbConnection.php';
	$final=false;
if(!isset($_SESSION['stdname'])) {
    echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
}else if(isset($_REQUEST['next']) || isset($_REQUEST['summary']) || isset($_REQUEST['viewsummary']))
    {
        //next question
        $answer='unanswered';
        if(time()<strtotime($_SESSION['endtime']))
        {
            if(isset($_REQUEST['markreview']))
            {
                $answer='review';
            }
            else if(isset($_REQUEST['answer']))
            {
                $answer='answered';
            }
            else
            {
                $answer='unanswered';
            }
            if(strcmp($answer,"unanswered")!=0)
            {
                if(strcmp($answer,"answered")==0)
                {
                    $query="update studentquestion set answered='answered',stdanswer='".$_REQUEST['answer']."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['tid']." and qnid=".$_SESSION['qn'].";";
                }
                else
                {
                    $query="update studentquestion set answered='review',stdanswer='".$_REQUEST['answer']."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['tid']." and qnid=".$_SESSION['qn'].";";
                }
                if(!executeQuery($query))
                {
              
                $_GLOBALS['message']="Your previous answer is not updated.Please answer once again";
                }
                closedb();
            }
            if(isset($_REQUEST['viewsummary']))
            {
                 header('Location: summary.php');
            }
            if(isset($_REQUEST['summary']))
             {
                     //summary page
                     header('Location: summary.php');
             }
        }
        if((int)$_SESSION['qn']<(int)$_SESSION['tqn'])
        {
        $_SESSION['qn']=$_SESSION['qn']+1;
       
        }
        if((int)$_SESSION['qn']==(int)$_SESSION['tqn'])
        {
           $final=true;
        }

    }
    else if(isset($_REQUEST['previous']))
    {
    // Perform the changes for current question
        $answer='unanswered';
        if(time()<strtotime($_SESSION['endtime']))
        {
            if(isset($_REQUEST['markreview']))
            {
                $answer='review';
            }
            else if(isset($_REQUEST['answer']))
            {
                $answer='answered';
            }
            else
            {
                $answer='unanswered';
            }
            if(strcmp($answer,"unanswered")!=0)
            {
                if(strcmp($answer,"answered")==0)
                {
                    $query="update studentquestion set answered='answered',stdanswer='".$_REQUEST['answer']."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['tid']." and qnid=".$_SESSION['qn'].";";
                }
                else
                {
                    $query="update studentquestion set answered='review',stdanswer='".$_REQUEST['answer']."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['tid']." and qnid=".$_SESSION['qn'].";";
                }
                if(!executeQuery($query))
                {
                
                $_GLOBALS['message']="Your previous answer is not updated.Please answer once again";
                }
                closedb();
            }
        }
        //previous question
        if((int)$_SESSION['qn']>1)
        {
            $_SESSION['qn']=$_SESSION['qn']-1;
        }

    }

    else if(isset($_REQUEST['fs']))
    {
      
        executeQuery("update studenttest set status='over' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['tid'].";");
        header('Location: testack.php');
    }

?>
<?php
header("Cache-Control: no-cache, must-revalidate");
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
                     $_GLOBALS['min']=$rslt['min'];
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
    <title>Test</title>
    <noscript><h2>For the proper Functionality, You must use Javascript enabled Browser</h2></noscript>
<?php
include "header.php";
?>
<div class="container">
	<form id="testconductor" action="testconductor.php" method="post">
			<div class="">
          <?php
         
          if(isset($_SESSION['stdname']))
          {
                $result=executeQuery("select stdanswer,answered from studentquestion where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['tid']." and qnid=".$_SESSION['qn'].";");
                $r1=mysqli_fetch_array($result);
                $result=executeQuery("select * from question where testid=".$_SESSION['tid']." and qnid=".$_SESSION['qn'].";");
                $r=mysqli_fetch_array($result);
          ?>
          <div class="">

              <table border="0" width="100%" class="">
                  <tr>
                      <th style="width:40%;"><h3><span id="timer" class="timerclass" style="<?php if($_GLOBALS['min']<1) { echo "color:red";} else {echo "color:green";} ?>"></span></h3></th>
                      <th style="width:40%;"><h4 style="color: #af0a36;">Question No: <?php echo $_SESSION['qn']; ?> </h4></th>
                      <th style="width:20%;text-align:right"><h4 style="color: #af0a36;"><input type="checkbox" name="markreview" value="mark"> Mark for Review</input></h4></th>
                  </tr>
              </table>
              <table><tr><td></td></tr></table>
             <textarea cols="102" rows="8" name="question" readonly style="width:100%;text-align:left;margin-left:0%;margin-top:2px;font-size:120%;font-weight:bold;margin-bottom:0;color:#0000ff;padding:2px 2px 2px 2px;resize:none;"><?php echo $r['question']; ?></textarea>
              <table border="0" width="100%" class="">
                  <tr><td>&nbsp;</td></tr>
                  <tr><td >1. <input type="radio" name="answer" value="optiona" <?php if((strcmp($r1['answered'],"review")==0 ||strcmp($r1['answered'],"answered")==0)&& strcmp($r1['stdanswer'],"optiona")==0 ){echo "checked";} ?>> <?php echo $r['optiona']; ?></input></td></tr>
                  <tr><td >2. <input type="radio" name="answer" value="optionb" <?php if((strcmp($r1['answered'],"review")==0 ||strcmp($r1['answered'],"answered")==0)&& strcmp($r1['stdanswer'],"optionb")==0 ){echo "checked";} ?>> <?php echo $r['optionb']; ?></input></td></tr>
                  <tr><td >3. <input type="radio" name="answer" value="optionc" <?php if((strcmp($r1['answered'],"review")==0 ||strcmp($r1['answered'],"answered")==0)&& strcmp($r1['stdanswer'],"optionc")==0 ){echo "checked";} ?>> <?php echo $r['optionc']; ?></input></td></tr>
                  <tr><td >4. <input type="radio" name="answer" value="optiond" <?php if((strcmp($r1['answered'],"review")==0 ||strcmp($r1['answered'],"answered")==0)&& strcmp($r1['stdanswer'],"optiond")==0 ){echo "checked";} ?>> <?php echo $r['optiond']; ?></input></td></tr>
                  <tr><td>&nbsp;</td></tr>
                  <tr>
                      <th style="width:80%;text-align:left;"><h4><input type="submit" name="previous" value="Previous" class="btn btn-primary"/></h4></th>

                      <th style="width:12%;"><h4><input type="submit" name="<?php if($final==true){ echo "viewsummary" ;}else{ echo "next";} ?>" value="<?php if($final==true){ echo "View Summary" ;}else{ echo "Next";} ?>" class="btn btn-primary"/></h4></th>
                      
                      <th style="width:8%;text-align:right;"><h4><input type="submit" name="summary" value="Summary" class="btn btn-success" /></h4></th>
                  </tr>
                  
              </table>
              

          </div>
          <?php
          closedb();
          }
          ?>
      </div>
	</form>
</div>

<?php
include "footer.php";
?>