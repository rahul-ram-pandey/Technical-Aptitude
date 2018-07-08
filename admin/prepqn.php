<?php
error_reporting(0);
session_start();
include_once '../dbConnection.php';

if (!isset($_SESSION['admname'])) {
  echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
}
else if(isset($_REQUEST['gototest'])){

header('Location: testmng.php');
}
else if (isset($_REQUEST['submit'])) {
	$_GLOBALS['message'] = "Add Clicked";
    $cancel = false;
    $result = executeQuery("select max(qnid) as qn from question where testid=" . $_SESSION['testqn'] . ";");
    $r = mysql_fetch_array($result);
    if (is_null($r['qn']))
        $newstd = 1;
    else
        $newstd=$r['qn'] + 1;

    $result = executeQuery("select count(*) as q from question where testid=" . $_SESSION['testqn'] . ";");
    $r2 = mysql_fetch_array($result);

    $result = executeQuery("select totalquestions from test where testid=" . $_SESSION['testqn'] . ";");
    $r1 = mysql_fetch_array($result);

    if (!is_null($r2['q']) && (int) $r1['totalquestions'] == (int) $r2['q']) {
        $cancel = true;
        $_GLOBALS['message'] = "Already you have created all the Questions for this Test.<br /><b>Help:</b> If you still want to add some more questions then edit the test settings(option:Total Questions).";
    }
    else
        $cancel=false;

    $result = executeQuery("select * from question where testid=" . $_SESSION['testqn'] . " and question='" . $_REQUEST['question']. "';");
    if (!$cancel && $r1 = mysql_fetch_array($result)) {
        $cancel = true;
        $_GLOBALS['message'] = "Question already exists";
    } else if (!$cancel)
        $cancel = false;

    if (strcmp($_REQUEST['correctans'], "<Choose the Correct Answer>") == 0 || empty($_REQUEST['question']) || empty($_REQUEST['optiona']) || empty($_REQUEST['optionb']) || empty($_REQUEST['optionc']) || empty($_REQUEST['optiond']) || empty($_REQUEST['marks'])) {
        $_GLOBALS['message'] = "Some of the required Fields are Empty";
    } else if (strcasecmp($_REQUEST['optiona'], $_REQUEST['optionb']) == 0 || strcasecmp($_REQUEST['optiona'], $_REQUEST['optionc']) == 0 || strcasecmp($_REQUEST['optiona'], $_REQUEST['optiond']) == 0 || strcasecmp($_REQUEST['optionb'], $_REQUEST['optionc']) == 0 || strcasecmp($_REQUEST['optionb'], $_REQUEST['optiond']) == 0 || strcasecmp($_REQUEST['optionc'], $_REQUEST['optiond']) == 0) {
        $_GLOBALS['message'] = "Two or more options are representing same answers.Verify Once again";
    } else if (!$cancel) {
        $query = "insert into question values(" . $_SESSION['subqn'] . "," . $_SESSION['testqn'] . ",$newstd,'" .$_REQUEST['question']. "','" . $_REQUEST['optiona']. "','" .$_REQUEST['optionb']. "','" .$_REQUEST['optionc']. "','" . $_REQUEST['optiond']. "','" . $_REQUEST['correctans']. "'," .$_REQUEST['marks']. ")";
        if (!@executeQuery($query))
            $_GLOBALS['message'] = mysql_error();
        else
            $_GLOBALS['message'] = "Successfully New Question is Created.";
    }
    closedb();
}
else if (isset($_REQUEST['edit'])){
$_GLOBALS['message'] = $_GLOBALS['message'] . "edit ".$_REQUEST['edit']."";
$result = executeQuery("select * from question where testid='".$_SESSION['testqn']."' and qnid='".$_REQUEST['edit']."';");
$r = mysql_fetch_array($result);
$_REQUEST['qnid'] = $r['qnid'];
$_REQUEST['quest'] = $r['question'];
$_REQUEST['optiona']=$r['optiona'];
$_REQUEST['optionb']=$r['optionb'];
$_REQUEST['optionc']=$r['optionc'];
$_REQUEST['optiond']=$r['optiond'];
$_REQUEST['marks']=$r['marks'];
$_REQUEST['correctans']=$r['correctanswer'];
echo "".$_REQUEST['tname']."";

}
else if (isset($_REQUEST['del'])){
 $_GLOBALS['message'] = $_GLOBALS['message'] . "delete ".$_REQUEST['del']." done";
 executeQuery("delete from question where testid='".$_SESSION['testqn']."' and qnid='".$_REQUEST['del']."';");

}
else if (isset($_REQUEST['update'])){

 if (strcmp($_REQUEST['correctans'], "<Choose the Correct Answer>") == 0 || empty($_REQUEST['question']) || empty($_REQUEST['optiona']) || empty($_REQUEST['optionb']) || empty($_REQUEST['optionc']) || empty($_REQUEST['optiond']) || empty($_REQUEST['marks'])) {
        $_GLOBALS['message'] = "Some of the required Fields are Empty";
    } else if (strcasecmp($_REQUEST['optiona'], $_REQUEST['optionb']) == 0 || strcasecmp($_REQUEST['optiona'], $_REQUEST['optionc']) == 0 || strcasecmp($_REQUEST['optiona'], $_REQUEST['optiond']) == 0 || strcasecmp($_REQUEST['optionb'], $_REQUEST['optionc']) == 0 || strcasecmp($_REQUEST['optionb'], $_REQUEST['optiond']) == 0 || strcasecmp($_REQUEST['optionc'], $_REQUEST['optiond']) == 0) {
        $_GLOBALS['message'] = "Two or more options are representing same answers.Verify Once again";
    } else {
        $query = "update question set question='" . htmlspecialchars($_REQUEST['question'],ENT_QUOTES) . "',optiona='" . htmlspecialchars($_REQUEST['optiona'],ENT_QUOTES) . "',optionb='" . htmlspecialchars($_REQUEST['optionb'],ENT_QUOTES) . "',optionc='" . htmlspecialchars($_REQUEST['optionc'],ENT_QUOTES) . "',optiond='" . htmlspecialchars($_REQUEST['optiond'],ENT_QUOTES) . "',correctanswer='" . htmlspecialchars($_REQUEST['correctans'],ENT_QUOTES) . "',marks=" . htmlspecialchars($_REQUEST['marks'],ENT_QUOTES) . " where testid=" . $_SESSION['testqn'] . " and qnid=" . $_REQUEST['qnid'] . " ;";
        if (!@executeQuery($query))
            $_GLOBALS['message'] = mysql_error();
        else
            $_GLOBALS['message'] = "Question is updated Successfully.";
    }
    closedb();

}
?>



<title>Add Questions</title>
<?php
include "header.php";
?>
<div class="container-fluid">
	<form class="form-horizontal" id="prepqn" action="prepqn.php" method="post">
		<?php
		if (isset($_SESSION['admname'])&&isset($_SESSION['testqn'])) {
?>
<input type="hidden" name="qnid" value="<?php echo "".$_REQUEST['qnid'].""; ?>" />
<div class="row">
<div class="col-md-9"></div>

<button type="submit" class="btn btn-default black-background white" name="gototest">Manage Tests</button>
<?php
if((!isset($_REQUEST['addqn'])&&!isset($_REQUEST['edit']))||isset($_REQUEST['cancel'])){

?>
<button type="submit" class="btn btn-primary" name="addqn">Add Questions</button>
<div class="col-md-3">
</div>
</div>

<div class="row">
	<div class="col-md-3"></div>

	<div class="col-md-6">
		

   

		<?php
                                 $result = executeQuery("select * from question where testid=" . $_SESSION['testqn'] . " order by qnid;");
                                if (mysql_num_rows($result) == 0) {
                                    echo "<h3 style=\"color:#0000cc;text-align:center;\">No Questions Yet..!</h3>";
                                } else {
                                    $i = 0;
?>                     	
                                   
		<table class="table table-striped">
  			<tr><th>#</th><th>Question</th><th>Correct Answer</th><th>Marks</th><th>Edit</th><th>Delete</th</tr>
        
<?php } ?>

		<?php
			while ($r = mysql_fetch_array($result)) {
                                     
                echo "<tr>";
            echo "<td> ". $r['qnid'] ."</td>
            	  <td> " .$r['question']. "</td>
           		  <td> " .$r[$r['correctanswer']]. "</td>
           		  <td> " .$r['marks']. "</td>
           		  <td> <button type=\"submit\" class=\"btn btn-warning\" name=\"edit\" value=\"".$r['qnid']."\">Edit</button></td>
           		  <td> <button type=\"submit\" class=\"btn btn-danger\" name=\"del\" value=\"".$r['qnid']."\">Delete</button></td>
           		  
           		  </tr>";
             
                                    }


                 closedb();
		?>
		
	</div>

	<div class="col-md-3"></div>


</div>
<?php }  }else{echo"<h2>Session Timeout</h2>";} ?>

<!--Display Message-->
 <?php
    $result = executeQuery("select count(*) as q from question where testid=" . $_SESSION['testqn'] . ";");
    $r1 = mysql_fetch_array($result);

    $result = executeQuery("select totalquestions from test where testid=" . $_SESSION['testqn'] . ";");
    $r2 = mysql_fetch_array($result);
    if ((int) $r1['q'] == (int) $r2['totalquestions'])
        echo "<div class=\"\"> Test Name: " . $_SESSION['testname'] . "<br/>Status: All the Questions are Created for this test.</div>";
    else
    {
        echo "<div class=\"\"> Test Name: " . $_SESSION['testname'] . "";
    	echo "<br/>Status: Still you need to create " . ($r2['totalquestions'] - $r1['q']) . " Question/s. After that only, test will be available for candidates.</div>";
    }
    ?>
<!--Add question, edit question-->

<div class="row">
<div class="col-md-3"></div>
<?php
if(isset($_REQUEST['addqn'])||isset($_REQUEST['edit'])){
?>
<div class="col-md-6">
<br><br>
	<div class="panel panel-default">
<?php
if(isset($_REQUEST['addqn'])){
?>	<div class="panel-heading"><b>Add Question</b></div> <?php } ?>
<?php
if(isset($_REQUEST['edit'])){
?>	<div class="panel-heading"><b>Edit Question</b></div> <?php } ?> 
				
				<div class="panel-body">

					 <div class="form-group">
				    <label for="quest" class="col-sm-3 control-label">Question</label>
					<div class="col-sm-9">
					
					<textarea class="form-control resize" rows="3" name="question"><?php
					if(isset($_REQUEST['edit'])){echo "".$_REQUEST['quest']."";}?></textarea>
					</div>
				    </div>


					<div class="form-group">
				    <label for="optiona" class="col-sm-3 control-label">Option A</label>
					<div class="col-sm-9">
					
					<input type="text" class="form-control" name="optiona" value="<?php
					if(isset($_REQUEST['edit'])){echo "".$_REQUEST['optiona']."";}?>" />
					</div>
				    </div>

				    <div class="form-group">
				    <label for="optionb" class="col-sm-3 control-label">Option B</label>
					<div class="col-sm-9">
					
					<input type="text" class="form-control" name="optionb" value="<?php
					if(isset($_REQUEST['edit'])){echo "".$_REQUEST['optionb']."";}?>" />
					</div>
				    </div>

				   <div class="form-group">
				    <label for="optionc" class="col-sm-3 control-label">Option C</label>
					<div class="col-sm-9">
					
					<input type="text" class="form-control" name="optionc" value="<?php
					if(isset($_REQUEST['edit'])){echo "".$_REQUEST['optionc']."";}?>" />
					</div>
				    </div>

				    <div class="form-group">
				    <label for="optiond" class="col-sm-3 control-label">Option D</label>
					<div class="col-sm-9">
					
					<input type="text" class="form-control" name="optiond" value="<?php
					if(isset($_REQUEST['edit'])){echo "".$_REQUEST['optiond']."";}?>" />
					</div>
				    </div>

				    <div class="form-group">
				    <label for="total" class="col-sm-3 control-label">Answer</label>
					<div class="col-sm-9">
					
					<select class="form-control" name="correctans">
					<option value="<Choose the Correct Answer>" selected>&lt;Choose the Correct Answer&gt;</option>
									   <option value="optiona" <?php if(isset($_REQUEST['edit'])) if (strcmp($r['correctanswer'], "optiona") == 0)   
									    echo "selected"; ?>>Option A</option>
                                                    <option value="optionb" <?php if(isset($_REQUEST['edit'])) if (strcmp($r['correctanswer'], "optionb") == 0)
                                        echo "selected"; ?>>Option B</option>
                                                    <option value="optionc" <?php if(isset($_REQUEST['edit'])) if (strcmp($r['correctanswer'], "optionc") == 0)
                                        echo "selected"; ?>>Option C</option>
                                                    <option value="optiond" <?php if(isset($_REQUEST['edit'])) if (strcmp($r['correctanswer'], "optiond") == 0)
                                        echo "selected"; ?>>Option D</option>
					  </select>
					</div>
				    </div>

				    <div class="form-group">
				    <label for="marks" class="col-sm-3 control-label">Marks</label>
					<div class="col-sm-9">
					
					<input type="text" class="form-control" name="marks" value="1" onkeyup="isnum(this);" value="<?php
					if(isset($_REQUEST['edit'])){echo "".$_REQUEST['marks']."";}?>"/>
					</div>
				    </div>
				    <div class="form-group">
				   <div class="col-sm-offset-3 col-sm-8">
						<?php
					if(isset($_REQUEST['addqn'])){
					?>	<button type="submit" class="btn btn-default black-background white" name="submit" onclick="validateqnform('testmng');"><span class="glyphicon glyphicon-log-in"></span>  Submit </button> <?php } ?>
					<?php
					if(isset($_REQUEST['edit'])){
					?>	<button type="submit"  class="btn btn-default black-background white" name="update" onclick="validateqnform('testmng');"><span class="glyphicon glyphicon-log-in"></span>  Update </button> <?php } ?> 


						<button type="submit" class="btn btn-default black-background white" name="cancel"><span class="glyphicon glyphicon-log-in"></span>  Cancel  </button>
				   </div>
				   </div>
				</div>
	</div>

</div>
<?php } closedb(); ?>

<div class="col-md-3"></div>
<!--end of add, edit question-->

	</form>

</div>
<br><br><br><br>
<?php
include "footer.php";
?>