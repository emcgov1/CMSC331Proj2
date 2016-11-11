<?php
session_start();
  //Now needs to do some cool database stuff...? Right? That sounds about right

include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

//This gets the whole value for the button the user chose
//The format is MM/DD.hhmm (in military time)
$button = ($_POST['appointment']);

//Split up the button to get time, month, and day
$time = substr($button, 5);
$date = substr($button, 0, -5);
$month = substr($date, 0, -2);
$day = substr($date, 2);

$campusID = $_SESSION['id'];
$_SESSION['adName'] = "Group Appointment";
$_SESSION['time'] = $button;
$_SESSION['hasAppointment'] = true;

//This pulls from the table, in order for my logic below to work.
$sql = mysql_query("SELECT `date`, `time`, `available`, `name`, `campusID1`, `campusID2`, `campusID3`, `campusID4`, `campusID5`, `campusID6`, `campusID7`, `campusID8`, `campusID9`, `campusID10`, `location` FROM `advisor_table`");

/******************
Here's how my logic works:
1. It pulls from the table, I couldn't get it to work with just pulling certain values, so it pulls everything.
2. It loops through each row it pulls and first checks if the name is "Group" if it's availabe ("T") and if the time is the time that the button was requesting. 
3. Once those factors are correct, it gets the whole date string...
4. It splits the date string into month and day so that I can compare them to the month and day the user picked
5. If if matches, then it looks for the next available campus ID slot and updates the table to fill that slot with the user's campusID number. 
 ******************/


if($sql == FALSE) {
  echo"error<br>";
}

$sql2;

while($row = mysql_fetch_array($sql)) {
  //get the date from the data base, if the month and day match, it's available and the same time as the appointment picked... check that row
  if($row["name"] == "Group" and $row["available"] == "T" and $row["time"] == $time) {
  $dateD = $row["date"];
  $dayD = substr($dateD, -2);
  $monthD = substr($dateD, 5, -3);
  //if they have the same month and date
  if($monthD == $month and $dayD == $day) {
    //set location session variable
    $_SESSION['loc'] = $row['location'];

    //need to update table to the next null field
    //if they have no value, they contain an empty string
    if($row["campusID1"] == "") {
      //echo"campusID1 is null <br>";
      $sql2 = "UPDATE advisor_table SET `campusID1` = '$campusID' WHERE `time` = '$time' AND `name` = 'Group' AND `date` = '$dateD'";
    } else if($row["campusID2"] == "") {
      //echo"campusID2 is null <br>";
      $sql2 = "UPDATE advisor_table SET `campusID2` = '$campusID' WHERE `time` = '$time' AND `name` = 'Group' AND `date` = '$dateD'";
    } else if($row["campusID3"] == "") {
      //echo"campusID3 is null <br>";
      $sql2 = "UPDATE advisor_table SET `campusID3` = '$campusID' WHERE `time` = '$time' AND `name` = 'Group' AND `date` = '$dateD'";
    } else if($row["campusID4"] == "") {
      //echo"campusID4 is null <br>";
      $sql2 = "UPDATE advisor_table SET `campusID4` = '$campusID' WHERE `time` = '$time' AND `name` = 'Group' AND `date` = '$dateD'";
    } else if($row["campusID5"] == "") {
      //echo"campusID5 is null <br>";
      $sql2 = "UPDATE advisor_table SET `campusID5` = '$campusID' WHERE `time` = '$time' AND `name` = 'Group' AND `date` = '$dateD'";
    } else if($row["campusID6"] == "") {
      //echo"campusID6 is null <br>";
      $sql2 = "UPDATE advisor_table SET `campusID6` = '$campusID' WHERE `time` = '$time' AND `name` = 'Group' AND `date` = '$dateD'";
    } else if($row["campusID7"] == "") {
      //echo"campusID7 is null <br>";
      $sql2 = "UPDATE advisor_table SET `campusID7` = '$campusID' WHERE `time` = '$time' AND `name` = 'Group' AND `date` = '$dateD'";
    } else if($row["campusID8"] == "") {
      //echo"campusID8 is null <br>";
	$sql2 = "UPDATE advisor_table SET `campusID8` = '$campusID' WHERE `time` = '$time' AND `name` = 'Group' AND `date` = '$dateD'";
    } else if($row["campusID9"] == "") {
      //echo"campusID9 is null <br>";
      $sql2 = "UPDATE advisor_table SET `campusID9` = '$campusID' WHERE `time` = '$time' AND `name` = 'Group' AND `date` = '$dateD'";
    } else if($row["campusID10"] == "") {
      //echo"campusID10 is null <br>";
      $sql2 = "UPDATE advisor_table SET `available` = 'F', `campusID10` = '$campusID' WHERE `time` = '$time' AND `name` = 'Group' AND `date` = '$dateD'" ;
    }
  }
}
}

//send the request to the server
$rs = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);

header('location:confirmation.php');

?>