<html>
<head>
<metacharset="utf8">
  <title>Confirmation</title>
  <link rel="stylesheet" href="standard.css" type="text/css" />

</head>
<body>

<?php
session_start();

include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

echo"<div class='form'>";
echo"<h1>Confirmation Page</h1>";
echo"<br>";

//The values we need that were set in either group or individual
$timeVal = $_SESSION['time'];
$adName =  $_SESSION['adName'];
$loc = $_SESSION['loc'];
$date = $_SESSION['date'];

//format time and date to look prettier
$time = myTime($timeVal);
$newDate = myDate($date);

//Display information about the appointment
echo"Your appointment is: ".$newDate."<br>";
echo"Your appointment is at ".$time."<br>";
echo"Advisor: ".$adName."<br>";
echo"Location: $loc<br>";

//When they hit the confirm button, send them to the menu
echo"<form action='menu.php' method='post' name='logout'>";
echo"<br>";
echo"<input type='submit' value='Confirm' name='button'>";
echo"</form>";

echo"</div>";


//The myTime function takes the value which is in the format MMDD.hhmm (in military time) and then it determines the pretty output string
function myTime($value) {
  $string = "";
  $valueTime = substr($value, 5);
  switch($valueTime) {
  case "0800":
    return $string = "8:00am - 8:30am &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "0830":
    return $string = "8:30am - 9:00am &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "0900":
    return $string = "9:00am - 9:30am &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "0930":
    return $string = "9:30am - 10:00am &nbsp;&nbsp;&nbsp";
  case "1000":
    return $string = "10:00am - 10:30am &nbsp;";
  case "1030":
    return $string = "10:30am - 11:00am &nbsp;";
  case "1100":
    return $string = "11:00am - 11:30am &nbsp;";
  case "1130":
    return $string = "11:30am - 12:00pm &nbsp;";
  case "1200":
    return $string = "12:00pm - 12:30pm &nbsp;";
  case "1230":
    return $string = "12:30pm - 1:00pm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "1300":
    return $string = "1:00pm - 1:30pm&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "1330":
    return $string = "1:30pm - 2:00pm &nbsp;&nbsp;&nbsp;&nbsp;";
  case "1400":
    return $string = "2:00pm - 2:30pm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "1430":
    return $string = "2:30pm - 3:00pm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "1500":
    return $string = "3:00pm - 3:30pm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  case "1530":
    return $string = "3:30pm - 4:00pm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  }
  return $string;
}


//This function takes the whole value string containing date in "YYYY-MM-DD" format and formats the date to be "MM/DD/YYYY"
function myDate($value) {
  $year = substr($value, 0, 4);
  $month = substr($value, 5, -3);
  $date = substr($value, 8);

  $string = $month."/".$date."/".$year;
  return $string;

}

?>