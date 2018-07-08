
<?php
error_reporting(0);
session_start();
include "../dbConnection.php";
if (!isset($_SESSION['admname'])) {
    echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Session Timeout. Click here to <a href=\"index.php\" class=\"alert-link\">Re-LogIn</a> </b></div>";
}
else if (isset($_REQUEST['submit'])) {

    $noerror = true;

    $result = executeQuery("select max(testid) as tst from test");
    $r = mysqli_fetch_array($result);
    if (is_null($r['tst']))
        $newstd = 1;
    else
        $newstd=$r['tst'] + 1;
    if (strcmp($_REQUEST['subject'], "<Choose the Subject>") == 0 || empty($_REQUEST['tname']) || empty($_REQUEST['tdesc']) || empty($_REQUEST['total']) || empty($_REQUEST['duration'])) {
        echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Some of the required fields are empty..!! </b></div>";

    }
    else if ($noerror) {
        $query = "insert into test values($newstd,'" .$_REQUEST['subject']. "','" .$_REQUEST['tname']. "','" . $_REQUEST['tdesc']. "','" .$_REQUEST['duration']. "','" .$_REQUEST['total']. "',0)";
        if (!@executeQuery($query)) {
            if (mysqli_errno () == 1062){ //duplicate value
               echo "<div class=\"alert alert-danger\" role=\"alert\"><b>";
              $_GLOBALS['message']="Test with same name already exists. </b></div>";
            }
            else
            {
           
              $_GLOBALS['message']=mysqli_error();
             }  
        }
        else{
             echo "<div class=\"alert alert-success\" role=\"success\"><b>";
              $_GLOBALS['message']="Successfully new test is created. </b></div>";
    }
    }
    
}
else if (isset($_REQUEST['edit'])) {

$result = executeQuery("select * from test where testid='".$_REQUEST['edit']."';");
$r = mysqli_fetch_array($result);

$_REQUEST['tid'] = $r['testid'];
$_REQUEST['tname']=$r['testname'];
$_REQUEST['tdesc']=$r['testdesc'];
$_REQUEST['duration']=$r['duration'];
$_REQUEST['total']=$r['totalquestions'];

}
else if (isset($_REQUEST['del'])) {
  echo "<div class=\"alert alert-success\" role=\"success\"><b>";
              $_GLOBALS['message']="Deleted Successfully. </b></div>";
 executeQuery("delete from test where testid='".$_REQUEST['del']."';");
  executeQuery("delete from question where testid='".$_REQUEST['del']."';");	
}
else if (isset($_REQUEST['manage'])) {
$_GLOBALS['message'] = $_GLOBALS['message'] . "manage";
$testname = $_REQUEST['manage'];
    $result = executeQuery("select testid,subid from test where testname='" .$testname. "';");

    if ($r = mysqli_fetch_array($result)) {
        $_SESSION['testname'] = $testname;
        $_SESSION['testqn'] = $r['testid'];
         $_SESSION['subqn'] = $r['subid'];
        header('Location: prepqn.php');
    }
	
}
else if (isset($_REQUEST['update'])) {
	$noerror = true;
	 if (strcmp($_REQUEST['subject'], "<Choose the Subject>") == 0 || empty($_REQUEST['tname']) || empty($_REQUEST['tdesc']) || empty($_REQUEST['total']) || empty($_REQUEST['duration'])) {
        echo "<div class=\"alert alert-danger\" role=\"success\"><b>";
              $_GLOBALS['message']="Some of the required fields are empty. </b></div>";
        $noerror=false;
    }
    else if($noerror){
 executeQuery("update test set testname='".$_REQUEST['tname']."',testdesc='".$_REQUEST['tdesc']."',duration='".$_REQUEST['duration']."',totalquestions='".$_REQUEST['total']."' where testid='".$_REQUEST['tid']."';");
echo "<div class=\"alert alert-success\" role=\"success\"><b>";
              $_GLOBALS['message']="Edited Successfully. </b></div>";
}
}
closedb();
?>
<title>Add Tests</title>
<?php
include "header.php";
?>
<div class="container-fluid">
<form class="form-horizontal" id="testmng" action="testmng.php" method="post">
<?php
		if (isset($_SESSION['admname'])) {
if((!isset($_REQUEST['addtest'])&&!isset($_REQUEST['edit']))||isset($_REQUEST['cancel'])){

?>
<div class="row">
<div class="col-md-9"></div>
<button type="submit" class="btn btn-primary" name="addtest">Add Test</button>

<div class="col-md-3"></div>
</div>

<div class="row">
	<div class="col-md-3"></div>

	<div class="col-md-6">
		

   

		<?php
				 if (isset($_REQUEST['forpq']))
        echo "<div class=\"alert alert-warning\" style=\"text-align:center\"><h4 style=\"color:black\"> Which test questions Do you want to Manage? <br/><b>Help:</b>Click on Manage button to manage the questions of respective tests</h4></div>";

    

                                $result = executeQuery("select t.testid,t.testname,t.testdesc, s.name from test as t, subject as s where t.subid=s.subid;");
                                if (mysqli_num_rows($result) == 0) {
                                    echo "<div class=\"alert alert-danger\" style=\"text-align:center\"><h4 style=\"color:black\">No test added yet..!!</h4></div>";
                                } else {
                                	

        ?>                        	
                                   
		<table class="table table-striped">
  			<tr><th>#</th><th>Subject Name</th><th>Test Name</th><th>Description</th><th>Edit</th><th>Delete</th><th>Manage</th></tr>
        
<?php } ?>

		<?php
			while ($r = mysqli_fetch_array($result)) {
                                     
                echo "<tr>";
            echo "<td> ". $r['testid'] ."</td>
            	  <td> ". $r['name'] ."</td>
            	  <td> " .$r['testname']. "</td>
           		  <td> " .$r['testdesc']. "</td>
           		  <td> <button type=\"submit\" class=\"btn btn-warning\" name=\"edit\" value=\"".$r['testid']."\">Edit</button></td>
           		  <td> <button type=\"submit\" class=\"btn btn-danger\" name=\"del\" value=\"".$r['testid']."\">Delete</button></td>
           		  <td> <button type=\"submit\" class=\"btn btn-success\" name=\"manage\" value=\"".$r['testname']."\">Manage</button></td>
           		  </tr>";
             
                                    }


                 closedb();
		?>
		
	</div>

	<div class="col-md-3"></div>


</div>
<?php }  }else{echo"<h2>Session Timeout</h2>";} ?>
<input type="hidden" name="tid" value="<?php echo "".$_REQUEST['tid'].""; ?>" />
<div class="row">
<div class="col-md-3"></div>
<?php
if(isset($_REQUEST['addtest'])||isset($_REQUEST['edit'])){
?>
<div class="col-md-6">
<br><br>
	<div class="panel panel-default">
<?php
if(isset($_REQUEST['addtest'])){
?>	<div class="panel-heading"><b>Add Test</b></div> <?php } ?>
<?php
if(isset($_REQUEST['edit'])){
?>	<div class="panel-heading"><b>Edit Test</b></div> <?php } ?> 
				
				<div class="panel-body">
					<div class="form-group">
				    <label for="subject" class="col-sm-3 control-label">Subject Name</label>
					<div class="col-sm-9">
					
					 <select name="subject" class="form-control">
                                    <option selected value="<Choose the Subject>">&lt;Choose the Subject&gt;</option>
<?php
        $result = executeQuery("select subid,name from subject;");
        while ($r = mysqli_fetch_array($result)) {

            echo "<option value=\"" . $r['subid'] . "\">" .$r['name']. "</option>";
        }
        	if(isset($_REQUEST['edit'])){echo "".$_REQUEST['subject']."";}?>" />
        closedb();
?>
                                </select>
					</div>
				    </div>


					<div class="form-group">
				    <label for="tname" class="col-sm-3 control-label">Test Name</label>
					<div class="col-sm-9">
					
					<input type="text" class="form-control" name="tname" value="<?php
					if(isset($_REQUEST['edit'])){echo "".$_REQUEST['tname']."";}?>" />
					</div>
				    </div>

				    <div class="form-group">
				    <label for="tdesc" class="col-sm-3 control-label">Description</label>
					<div class="col-sm-9">
					
					<textarea class="form-control resize" rows="3" name="tdesc"><?php
					if(isset($_REQUEST['edit'])){echo "".$_REQUEST['tdesc']."";}?></textarea>
					</div>
				    </div>

				    <div class="form-group">
				    <label for="total" class="col-sm-3 control-label">Total Questions</label>
					<div class="col-sm-9">
					
					<input type="text" class="form-control" name="total" onkeyup="isnum(this);" value="<?php
					if(isset($_REQUEST['edit'])){echo "".$_REQUEST['total']."";}?>" />
					</div>
				    </div>

				    <div class="form-group">
				    <label for="duration" class="col-sm-3 control-label">Duration(mins)</label>
					<div class="col-sm-9">
					
					<input type="text" class="form-control" name="duration" onkeyup="isnum(this);" value="<?php
					echo "".$_REQUEST['duration']."";?>"/>
					</div>
				    </div>
				    <div class="form-group">
				   <div class="col-sm-offset-3 col-sm-8">
						<?php
					if(isset($_REQUEST['addtest'])){
					?>	<button type="submit" class="btn btn-default black-background white" name="submit" onclick="validatetestform('testmng');"><span class="glyphicon glyphicon-log-in"></span>  Submit </button> <?php } ?>
					<?php
					if(isset($_REQUEST['edit'])){
					?>	<button type="submit"  class="btn btn-default black-background white" name="update" onclick="validatetestform('testmng');"><span class="glyphicon glyphicon-log-in"></span>  Update </button> <?php } ?> 


						<button type="submit" class="btn btn-default black-background white" name="cancel"><span class="glyphicon glyphicon-log-in"></span>  Cancel  </button>
				   </div>
				   </div>
				</div>
	</div>

</div>
<?php } ?>

<div class="col-md-3"></div>
</div>
</form>
</div>

<?php
include "footer.php";
?>
