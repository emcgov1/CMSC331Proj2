<html>
<head>
<metacharset="utf8">
  <title>Your Appointment!</title>
  <link rel="stylesheet" href="standard.css" type="text/css" />

</head>
<body>

<?php
   session_start();

include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

echo"<div class='form'>";
echo"<h1>Your Appointment</h1>";
echo"<br>";

//Get the various values that we need to display the appointment information
$timeVal = isset($_SESSION['time']) ? $_SESSION['time'] : "";
$adName =  isset($_SESSION['adName']) ? $_SESSION['adName'] : "";
$loc = isset($_SESSION['loc']) ? $_SESSION['loc'] : "";
$date = isset($_SESSION['date']) ? $_SESSION['date'] : "";
$id = $_SESSION['id'];

//if this is "", then the user didn't just make the appointment (i.e. they made appointment, logged out and logged back in)
if($timeVal == "") {
  $sql = mysql_query("SELECT `time`, `date`, `name`, `location` FROM `advisor_table` WHERE `campusID1`='$campusID' OR `campusID2`='$campusID' OR  `campusID3`='$campusID' OR `campusID4`='$campusID' OR `campusID5`='$campusID' OR `campusID6`='$campusID' OR `campusID7`='$campusID' OR `campusID8`='$campusID' OR `campusID9`='$campusID' OR `campusID10`='$campusID'");

  while($row = mysql_fetch_array($sql)) {
    $timeVal = $row['time'];
    $adName = $row['name'];
    $loc = $row['location'];
    $date = $row['date'];
  }
}

//format time and date to a prettier format
$time = myTime($timeVal);
$newDate = myDate($date);

//Display the information about the appointment
echo"Your appointment is: ".$newDate."<br>";
echo"Your appointment is at ".$time."<br>";
echo"Advisor: ".$adName."<br>";        
echo"Location: $loc<br>";
echo"<br>";
echo"<form action='menu.php' method='post' name='logout'>";
echo"<input type='submit' value='Return to Menu' name='button'>";
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