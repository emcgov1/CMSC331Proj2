<?php
include('advisorHeadHTML.html');
include('CommonMethods.php');

session_start();

$debug = false;
$COMMON = new Common($debug);

$fName = $_POST['tfFName'];
$lName = $_POST['tfLName'];
$campusID = $_POST['tfID'];
$email = $_POST['tfEmail'];
$office = $_POST['tfOffice'];

$_SESSION['fName'] = $fName;
$_SESSION['lName'] = $lName;
$_SESSION['loggedIn'] = true;
$_SESSION['id'] = $campusID;

// check if advisor id is already in table
$sql = "SELECT EXISTS(SELECT 1 FROM advising_table WHERE `campusID` = '${campusID}')";
$idExists = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$idExists = @mysql_fetch_array($idExists);

// if id does not exist, add data to database
if(!$idExists[0]) {
  $sql = "INSERT INTO advising_table (`fName`, `lName`, `campusID`, `email`, `office`) VALUES ('{$fName}', '${lName}', '${campusID}', '${email}', '${office}')"; 
  $result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}

// ignore data if advisor id already exists

header('Location: startCal.php');

include('tailHTML.html');
?>
