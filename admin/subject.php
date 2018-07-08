<?php
error_reporting(0);
session_start();
include_once '../dbConnection.php';
if (!isset($_SESSION['admname'])) {
    $_GLOBALS['message'] = "Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}
else if (isset($_REQUEST['submit'])) {

    $noerror = true;

    $result = executeQuery("select max(subid) as sub from subject");
    $r = mysqli_fetch_array($result);
    if (is_null($r['sub']))
        $newstd = 1;
    else
        $newstd=$r['sub'] + 1;
    if (empty($_REQUEST['tname']) || empty($_REQUEST['tdesc']) || empty($_REQUEST['pic'])) {
        $_GLOBALS['message'] = "Some of the required Fields are Empty";

    }
    else if ($noerror) {
        $query = "insert into subject values($newstd,'" .$_REQUEST['tname']. "','" .$_REQUEST['tdesc']. "','" . $_REQUEST['pic']. "')";
        if (!@executeQuery($query)) {
            if (mysqli_errno () == 1062) //duplicate value
                $_GLOBALS['message'] = "Subject already appears";
            else
                $_GLOBALS['message'] = mysqli_error();
        }
        else
            $_GLOBALS['message'] = $_GLOBALS['message'] . "<br/>Successfully New Subject is Created.";
    }
    
}
else if (isset($_REQUEST['edit'])) {
$_GLOBALS['message'] = $_GLOBALS['message'] . "edit ".$_REQUEST['edit']."";
$result = executeQuery("select * from subject where subid='".$_REQUEST['edit']."';");
$r = mysqli_fetch_array($result);

$_REQUEST['tid'] = $r['subid'];
$_REQUEST['tname']=$r['name'];
$_REQUEST['tdesc']=$r['sdesc'];
$_REQUEST['pic']=$r['image'];

echo "".$_REQUEST['tname']."";
}
else if (isset($_REQUEST['del'])) {
 $_GLOBALS['message'] = $_GLOBALS['message'] . "delete ".$_REQUEST['del']." done";
 executeQuery("delete from subject where subid='".$_REQUEST['del']."';");
 executeQuery("delete from test where subid='".$_REQUEST['del']."';");
 executeQuery("delete from question where subid='".$_REQUEST['del']."';");
}

else if (isset($_REQUEST['update'])) {
	$noerror = true;
	 if (empty($_REQUEST['tname']) || empty($_REQUEST['tdesc']) || empty($_REQUEST['pic'])) {
        $_GLOBALS['message'] = "Some of the required Fields are Empty";
        $noerror=false;
    }
    else if($noerror){
 executeQuery("update subject set name='".$_REQUEST['tname']."',sdesc='".$_REQUEST['tdesc']."',image='".$_REQUEST['pic']."' where subid='".$_REQUEST['tid']."';");
$_GLOBALS['message'] = $_GLOBALS['message'] . "Edited Successfully";
}
}
closedb();

?>



<?php
include "header.php";
?>
<title>Add Subjects</title>
<div class="container-fluid">
<form class="form-horizontal" id="subject" action="subject.php" method="post">
<?php
		if (isset($_SESSION['admname'])) {
if((!isset($_REQUEST['addtest'])&&!isset($_REQUEST['edit']))||isset($_REQUEST['cancel'])){

?>
<div class="row">
<div class="col-md-9"></div>
<button type="submit" class="btn btn-primary" name="addtest">Add Subjects</button>

<div class="col-md-3"></div>
</div>

<div class="row">
	<div class="col-md-3"></div>

	<div class="col-md-6">
		

   

		<?php
				 if (isset($_REQUEST['forpq']))
        echo "<div class=\"\" style=\"text-align:center\"> Which test questions Do you want to Manage? <br/><b>Help:</b>Click on Manage button to manage the questions of respective tests</div>";

    

                                $result = executeQuery("select s.subid,s.name,s.sdesc from subject as s;");
                                if (mysqli_num_rows($result) == 0) {
                                    echo "<h3 style=\"color:#0000cc;text-align:center;\">No Subjects Added Yet..!</h3>";
                                } else {
                                	

        ?>                        	
                                   
		<table class="table table-striped">
  			<tr><th>#</th><th>Subject Name</th><th>Description</th><th>Edit</th><th>Delete</th></tr>
        
<?php } ?>

		<?php
			while ($r = mysqli_fetch_array($result)) {
                                     
                echo "<tr>";
            echo "<td> ". $r['subid'] ."</td>
            	  <td> " .$r['name']. "</td>
           		  <td> " .$r['sdesc']. "</td>
           		  <td> <button type=\"submit\" class=\"btn btn-warning\" name=\"edit\" value=\"".$r['subid']."\">Edit</button></td>
           		  <td> <button type=\"submit\" class=\"btn btn-danger\" name=\"del\" value=\"".$r['subid']."\">Delete</button></td>
           		  
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
?>	<div class="panel-heading"><b>Add Subject</b></div> <?php } ?>
<?php
if(isset($_REQUEST['edit'])){
?>	<div class="panel-heading"><b>Edit Subject</b></div> <?php } ?> 
				
				<div class="panel-body">
					<div class="form-group">
				    <label for="tname" class="col-sm-3 control-label">Sub Name</label>
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
				    <label for="total" class="col-sm-3 control-label">Image URL</label>
					<div class="col-sm-9">
					
					<input type="file" name="pic" accept="image/*">
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