<?php
session_start();

include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

  //This gets the whole value for the button the user chose
$button = ($_POST['appointment']);

//This takes off the '..ad1', '..ad2', '..ad3', '..ad4' and sends mmdd.hhmm (military time)
$buttonT = substr($button, 0, -3);

$_SESSION['time'] = $buttonT;
$campusID = $_SESSION['id'];
$_SESSION['hasAppointment'] = true;

//The end of the button is always '..ad1', '..ad2', '..ad3', or '..ad4' for advisor 1, 2, 3, or 4.
$adType = substr($button, -3);
//echo("adType is: ".$adType."\n");

//Now determine which advisor was picked, then the time.
//Then send to database/let advisor know...?
if($adType == 'ad1') {
  //echo("in ad1 if statement\n");
  
  $aptTime = substr($button, 5, -3);
  //echo("aptTime is: ".$aptTime);

  $name = "Advisor 1";

  $_SESSION['adName'] = $name;

  //update the table, set the appointment to false and place the student ID in the campusID1 spot in the table
  $sql = "UPDATE advisor_table SET `available` = 'F', `campusID1` = '$campusID' WHERE `time` = '$aptTime' AND `name` = '$name'";

  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  //Then pull that same row we just updated to get the time and date. (Date needs to be YYYY-MM-DD for the logic in the next pages to work)
  $sqlLoc = mysql_query("SELECT `location`, `date` FROM `advisor_table` WHERE `available`='F' AND `campusID1`='$campusID'");
  while($row = mysql_fetch_array($sqlLoc)) {
    $_SESSION['loc'] = $row['location'];
    $_SESSION['date'] = $row['date'];
    echo"row[date] is: ".$row['date']."<br>";
  }
}

else if($adType == 'ad2') {
  //echo("in ad2 if statement\n");
  
  $aptTime = substr($button, 5, -3);
  //echo("aptTime is: ".$aptTime);
  
  $name = "Advisor 2";

  $_SESSION['adName'] = $name;

  //update the table, set the appointment to false and place the student ID in the campusID1 spot in the table
  $sql = "UPDATE advisor_table SET `available` = 'F',`campusID1` = '$campusID' WHERE `time` = '$aptTime' AND `name` = '$name'";

  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  //Then pull that same row we just updated to get the time and date. (Date needs to be YYYY-MM-DD for the logic in the next pages to work)
  $sqlLoc = mysql_query("SELECT `location`, `date` FROM `advisor_table` WHERE `available`='F' AND `campusID1`='$campusID'");
  while($row = mysql_fetch_array($sqlLoc)) {
    $_SESSION['loc'] = $row['location'];
    $_SESSION['date'] = $row['date'];
    echo"row[date] is: ".$row['date']."<br>";
  }
}

else if($adType == 'ad3') {
  //echo("in ad3 if statement\n");

  $aptTime = substr($button, 5, -3);
  //echo("aptTime is: ".$aptTime);

  $name = "Advisor 3";

  $_SESSION['adName'] = $name;

  //update the table, set the appointment to false and place the student ID in the campusID1 spot in the table
  $sql = "UPDATE advisor_table SET `available` = 'F',`campusID1` = '$campusID' WHERE `time` = '$aptTime' AND `name` = '$name'";

  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  //Then pull that same row we just updated to get the time and date. (Date needs to be YYYY-MM-DD for the logic in the next pages to work)
  $sqlLoc = mysql_query("SELECT `location`, `date` FROM `advisor_table` WHERE `available`='F' AND `campusID1`='$campusID'");
  while($row = mysql_fetch_array($sqlLoc)) {
    $_SESSION['loc'] = $row['location'];
    $_SESSION['date'] = $row['date'];
    echo"row[date] is: ".$row['date']."<br>";
  }
}

else if($adType == 'ad4') {
  //echo("in ad4 if statement\n");

  $aptTime = substr($button, 5, -3);
  //echo("aptTime is: ".$aptTime);

  $name = "Advisor 4";

  $_SESSION['adName'] = $name;

  //update the table, set the appointment to false and place the student ID in the campusID1 spot in the table
  $sql = "UPDATE advisor_table SET `available` = 'F',`campusID1` = 'campusID' WHERE `time` = '$aptTime' AND `name` = '$name'";

  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  //Then pull that same row we just updated to get the time and date. (Date needs to be YYYY-MM-DD for the logic in the next pages to work)
  $sqlLoc = mysql_query("SELECT `location`, `date`  FROM `advisor_table` WHERE `available`='F' AND `campusID1`='$campusID'");
  while($row = mysql_fetch_array($sqlLoc)) {
    $_SESSION['loc'] = $row['location'];
    $_SESSION['date'] = $row['date'];
    echo"row[date] is: ".$row['date']."<br>";
  }
}

else {
  echo("could not get adType\n");
}


header('location:confirmation.php'); //confirmation page

?>