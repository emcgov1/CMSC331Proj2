<?php
  //The page to cancel an appointment
session_start();

include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

//get the student's campus ID
$campusID = $_SESSION['id'];

$resched;
if(isset($_SESSION['reschedule'])) {
  $resched = true;
}

//Should we be cancel the appointment?
$cancel = isset($_POST['choice']) ? $_POST['choice'] : "" ;

$sqlUpdate;

if($cancel == "YES") {
  $_SESSION['hasAppointment'] = false;
  //cancel the appointment if it was individual, or remove the name if it was group
  $sql = mysql_query("SELECT `name`, `campusID1`, `campusID2`, `campusID3`, `campusID4`, `campusID5`, `campusID6`, `campusID7`, `campusID8`, `campusID9`, `campusID10` FROM `advisor_table` WHERE `campusID1` = '$campusID' OR `campusID2` = '$campusID' OR `campusID3` = '$campusID' OR `campusID4` = '$campusID' OR `campusID5` = '$campusID' OR `campusID6` = '$campusID' OR `campusID7` = '$campusID' OR `campusID8` = '$campusID' OR `campusID9` = '$campusID' OR `campusID10` = '$campusID'");

  $row = mysql_fetch_array($sql);
  if($row['name'] == "Group") {
    //determine which campusID slot to free up
    if($row['campusID1'] == $campusID) {
      $sqlUpdate = "UPDATE advisor_table SET `campusID1` = '' WHERE `campusID1` = '$campusID'";
    } else  if($row['campusID2'] == $campusID) {
      $sqlUpdate = "UPDATE advisor_table SET `campusID2` = '' WHERE `campusID2` = '$campusID'";
    } else if($row['campusID3'] == $campusID) {
      $sqlUpdate = "UPDATE advisor_table SET `campusID3` = '' WHERE `campusID3` = '$campusID'";
    } else  if($row['campusID4'] == $campusID) {
      $sqlUpdate = "UPDATE advisor_table SET `campusID4` = '' WHERE `campusID4` = '$campusID'";
    } else if($row['campusID5'] == $campusID) {
      $sqlUpdate = "UPDATE advisor_table SET `campusID5` = '' WHERE `campusID5` = '$campusID'";
    } else if($row['campusID6'] == $campusID) {
      $sqlUpdate = "UPDATE advisor_table SET `campusID6` = '' WHERE `campusID6` = '$campusID'";
    } else if($row['campusID7'] == $campusID) {
      $sqlUpdate = "UPDATE advisor_table SET `campusID7` = '' WHERE `campusID7` = '$campusID'";
    } else if($row['campusID8'] == $campusID) {
      $sqlUpdate = "UPDATE advisor_table SET `campusID8` = '' WHERE `campusID8` = '$campusID'";
    } else if($row['campusID9'] == $campusID) {
      $sqlUpdate = "UPDATE advisor_table SET `campusID9` = '' WHERE `campusID9` = '$campusID'";
    } else if($row['campusID10'] == $campusID) {
      //if the campus ID was in the last slot, make the appointment true now.
      $sqlUpdate = "UPDATE advisor_table SET `available` = 'T', `campusID10` = '' WHERE `campusID10` = '$campusID'";
    }
  } else {
    //set the appointment to true
    $sqlUpdate = "UPDATE advisor_table SET `available` = 'T', `campusID1` = '' WHERE `campusID1` = '$campusID'";
  }
  
  $rs = $COMMON->executeQuery($sqlUpdate, $_SERVER["SCRIPT_NAME"]);
}

$_SESSION['hasAppointment'] = false;

if($resched) {
  //if they chose to reschedule, they need to make a new appointment
  header('location:appointmentPage.php');
} else {
  //just head back to the menu
  header('location:menu.php');
}
?>