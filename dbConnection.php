<?php
include_once 'dbCredentials.php';
$conn=false;

function executeQuery($query)
{
    global $conn,$dbServer,$dbName,$dbPassword,$dbUserName;
    global $message;
    if (!($conn = @mysqli_connect ($dbServer,$dbUserName,$dbPassword)))
         $message="Cannot connect to server";
    if (!@mysqli_select_db ($dbName,$conn))
         $message="Cannot select database";

    $result=mysqli_query($query,$conn);
    if(!$result)
        $message="Error while executing query.<br/>Mysql Error: ".mysqli_error();
    else
        return $result;

}
function closedb()
{
    global $conn;
    if(!$conn)
    mysqli_close($conn);
}

?>