<?php
  //session_start();                                                                                                                                                     
include('startCal.php');
//include("startCal.html");                                                                                                                                              
$apptType = '';
include('CommonMethods.php');                                                                                                                                          
$debug = true;                                                                                                                                                         
$COMMON = new Common($debug);                                                                                                                                          
$firstName = $lastName = '';
$date = $_SESSION['date'];
$available = 'T';
//$apptTime = isset($_POST['apptTime']) ? $_POST['apptTime'] : "0000";                                                                                                   
$apptLoc = isset($_POST['apptLoc']) ? $_POST['apptLoc'] : "N/A";
echo"$apptLoc";
if(isset($_POST['newApp'])) {
  //$apptTime = ($_POST['apptTime']);                                                                                                                                    
  $apptTime = isset($_POST['apptTime']) ? $_POST['apptTime'] : "0000";
  //$apptLoc = ($_POST['apptLoc']);                                                                                                                                      
  //if it's individual, the fname in the database is the advisors first name and name is the advisors last name                                                          
  if($_POST['apptType'] == "indiv") {
    //$apptType = $_SESSION['adName'];                                                                                                                                   
    $firstName = $_SESSION['fName'];
    $lastName = $_SESSION['lName'];
  }
  //if it's group name is Group and fname is null                                                                                                                        
  if($_POST['apptType'] == "group") {
    //$apptType = "Group";                                                                                                                                               
    $firstName = '';
    $lastName = "Group";
  }
}
$sql = "INSERT INTO `advisor_table`(`date`, `time`, `name`, `fName`, `available`, `location`) VALUES ('$date', '$apptTime', '$lastName', '$firstName', '$available', '$apptLoc')";
$result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

header("location: startCal.php");
?>