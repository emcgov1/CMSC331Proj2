<?php
include('studentHeadHTML.html');
include('CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

session_start();

// add HTML form data to session variables so they can be placed in regSheet.php
$_SESSION['fName'] = $_POST['tfFName'];
$_SESSION['lName'] = $_POST['tfLName'];
$_SESSION['id'] = $_POST['tfID'];
$_SESSION['email'] = $_POST['tfEmail'];
$_SESSION['major'] = $_POST['ddMajor'];

$_SESSION['loggedIn'] = true;

// check if student has an appointment
$campusID = $_SESSION['id'];
$sql = "SELECT `campusID1`, `campusID2`, `campusID3`, `campusID4`, `campusID5`, `campusID6`, `campusID7`, `campusID8`, `campusID9`, `campusID10` FROM `advisor_table` WHERE `campusID1` = 'campusID' OR `campusID2` = '$campusID' OR `campusID3` = '$campusID' OR `campusID4` = '$campusID' OR `campusID5` = '$campusID' OR `campusID6` = '$campusID' OR `campusID7` = '$campusID' OR `campusID8` = '$campusID' OR `campusID9` = '$campusID' OR `campusID10` = '$campusID'";
$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

// if nothing was returned, student doesn't have an appointment
if(!empty($results)) {
  $_SESSION['hasAppointment'] = true;
  header('Location: menu.php');
} else {
  $_SESSION['hasAppointment'] = false;
  header('Location: regSheet.html');
}

include('tailHTML.html');
?>
