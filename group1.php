<html>
<head>
<metacharset="utf8">
  <title>Group Appointment</title>
  <link rel="stylesheet" href="standard.css" type="text/css" />

</head>
<body>

<?php
include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

$sql = mysql_query("SELECT `date`, `time`, `location` FROM `advisor_table` WHERE `available`='T' AND `name`='Group'");

//array to keep track of all of the group appointment times
$tArray = [];

while($row = mysql_fetch_array($sql)) {
  //get the day from the database
  $dayD = substr($row["date"], -2);
  //get the month from the database
  $monthD = substr($row["date"], 5, -3);
  
  $time = $monthD . $dayD;
  $time .= ".";
  $time .= $row["time"];
  $tArray[] = $time;
}

//print_r($tArray);
sort($tArray);
$total = count($tArray);


echo"<div class='group'>";
echo"<h1>Choose a time</h1><br>";
echo"<div class='groupBullet'>";
echo"<form action='group.php' method='post' name='form3'>";
for($x = 0; $x < $total; $x++) 
  {
    $timeVal = $tArray[$x];
    $value = myTime($tArray[$x]);
    $value .= "\t".myDate($tArray[$x]);
echo"<input type='radio' name='appointment' value=$timeVal>$value<br>";
  }
echo"<br>";
echo"<input type='submit'>";
echo"</form>";
echo"</div>";
echo"</div>";

//This function takes the whole value string containing time and date and formats it into hh:mm am - hh:mm am (or pm). The "&nbsp" puts space at the end of the line so that the date looks lined up when displayed on the screen. 
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

//This function takes the whole value string containing time and date and formats the date to be "MM/DD"                    
 function myDate($value) {
   $valueDate = substr($value, 0, -5);

   $month = substr($valueDate, 0, -2);
   $date = substr($valueDate, 2);

   $string = $month."/".$date;
   return $string;

 }

include('tailHTML.html');

?>