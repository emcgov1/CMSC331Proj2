<?php

  //session_start();

//use session variable called like variable and have it go back to the same html header() and then back in html there a php code isset and returns a boolean and if it isnt set do nothingbut if it is then show the info i need to show 
include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

//times of taken appointments                                                                                                                                                     
$timeArr = [];
//times of available appointments                                                                                                                                                 
$time2Arr = [];

//students in appointment                                                                                                                                                         
$student = [];
//group appointments taken                                                                                                                                                        
$group = [];
//group appointments available                                                                                                                                                    
$group2 = [];

$count = 0;

//month, date, and student in database                                                                                                                                            
$DBmonth;
$DBDay;
$DBYear;
$DBstud;
$currDate;



if(isset($_POST['selDate'])) {

  $_SESSION['date'] = '';

  $date = ($_POST['selDate']);
  //  echo("Date is: ".$date."\n");


  $_SESSION['date'] = '2016';
  $_SESSION['day'] = $date;
  $_SESSION['month'] = '11';
  $_SESSION['date'] .= '-';
  $_SESSION['date'] .= $_SESSION['month'];
  $_SESSION['date'] .= '-';
  $_SESSION['date'] .= '0';
  $_SESSION['date'] .= $_SESSION['day'];

  //get all the values from the table of advisor info 
  $sql = mysql_query("SELECT *  FROM `advisor_table`");

  /*
//times of taken appointments 
$timeArr = [];
//times of available appointments 
$time2Arr = [];

//students in appointment
$student = [];
//group appointments taken
$group = [];
//group appointments available 
$group2 = [];

$count = 0;

//month, date, and student in database 
$DBmonth;
$DBDay;
$DBYear;
$DBstud;
$currDate;
  */

  $_SESSION['adName'] = "Advisor 1";

  //get the inputed rows in the table 
  while($row = mysql_fetch_array($sql)) {
    //  $DBDay = substr($row["date"], -2);
    // $DBmonth = substr($row["date"], 5, -3);
  
    //available group meetings 
    if($row["available"] == "F" and $row["name"] == "Group") {
      $DBDay = substr($row["date"], -2);
      $DBmonth = substr($row["date"], 5, -3);
      if($DBDay == $date) {
	$rawTime = $row['time'];
	$time = substr($rawTime, 0, -2);
	$time .= ":";
	$time .= substr($rawTime, 2);

	$group[] = $time;
	//      print_r($group);
      }
 
      //taken group meetings
      if($row["available"] == "T" and $row["name"] == "Group") {
	$DBDay = substr($row["date"], -2);
	$DBmonth = substr($row["date"], 5, -3);
	if($DBDay == $date) {
	  $rawTime = $row['time'];
	  $time = substr($rawTime, 0, -2);
	  $time .= ":";
	  $time .= substr($rawTime, 2);

	  $group2[] = $time;
	}
      }
    }
  
    // taken individual meetings
    if($row["available"] == "F" and $row["name"] == $_SESSION['adName']) {
      // echo "date: ".$row["date"]. " - Time: " . $row["time"] . " - Available: " . $row["available"];
      $DBDay = substr($row["date"], -2);
      $DBmonth = substr($row["date"], 5, -3);
      if($DBDay == $date) {
	// echo"row time is: ".$row["time"]."<br>";
	$rawTime = $row['time'];
	$time = substr($rawTime, 0, -2);
	$time .= ":";
	$time .= substr($rawTime, 2);

	$timeArr[] = $time;
      }
    }
  
    //available individual meetings
    if($row["available"] == "T" and $row["name"] == $_SESSION['adName']) {
      $DBDay = substr($row["date"], -2);
      $DBmonth = substr($row["date"], 5, -3);
      //   echo"month: ".$DBmonth;
      if($DBDay == $date) {
	// echo"row time is: ".$row["time"]."<br>";
	$rawTime = $row['time'];
	$time = substr($rawTime, 0, -2);
	$time .= ":";
	$time .= substr($rawTime, 2);

	$time2Arr[] = $time;
      }
    }
  }
}
/*
for($x = 0; $x < count($timeArr); $x++)
  {
    echo"$timeArr[$x] <br>";
  }
*/

include("startCal.php");


//echo"<div style='float:left; width:75%;'>";
//echo"Select date using calenadar on the left";

///////////////html///////////////
echo"<h1>Current Appointments</h1>";
//lists group appointments
echo"<h2 style='text-align:left;'>Group Appointments</h2>";
for($x = 0; $x < count($group); $x++)
{
  echo"$group[$x] - Taken <br>";
}
for($x = 0; $x < count($group2); $x++)
{
  echo"$group2[$x] - Available <br>";
}
echo"<br>";
//lists individual appointments 
echo"<h2 style='text-align:left;'>Individual Appointments</h2>";

for($x = 0; $x < count($timeArr); $x++)
{
  echo"$timeArr[$x] - Taken  <br>";
}

for($x = 0; $x < count($time2Arr); $x++)
{
  echo"$time2Arr[$x] - Available <br>";
}
//echo"</div>";
echo"<br>";

//section to create new meeting
echo"<h2 style='text-align:left;'>Create New Appointment</h2>";
echo"<form action='newAppt.php' method='post' name='newAppointment'>";
echo"<input id='indiv' type='radio' name='apptType' value='indiv' style='text-align:left;'>";
echo"<label for='indiv'>Group</label><br>";
echo"<input id='group' type='radio' name='apptType' value='group' style='text-align:left;'>";
echo"<label for='group'>Individual</label><br>";
echo"<p><label for='apptTime'>Time (in military format - no colon): </label>";
echo"<input id='apptTime' type='text' name='apptTime' placeholder='1300 for 1:00pm'></p>";
echo"<p><label for='apptLoc'>Location: </label>";
echo"<input id='apptLoc' type='text' name='apptLoc' placeholder='ex. ITE 210'></p>";
echo"<input type='submit' name='newApp' value='Create'>";
echo"</form>";
echo"</body>";
echo"</head>";
echo"</html>";
?>