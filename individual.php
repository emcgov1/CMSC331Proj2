<html>
<head>
<metacharset="utf8">
  <title>Group Appointment</title>
  <link rel="stylesheet" href="standard.css" type="text/css" />

</head>
<body>

<?php
   session_start();

include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);


echo"<h1>Individual Appointment Page</h1>";
echo"<h1>Pick an advisor</h1>";

//Thing below allows user to select a date and then only appointments from that date will appear
?>
<!--An actual calendar will appear on Chrome, but not Safari.-->
<form action='' method='post'>
Date:<input type='date' name='date' placeholder='MM/DD/YYYY'>
<input type='submit'>
<?php
$date = isset($_POST['date']) ? $_POST['date'] : "";
?>
</form>

<?php
echo"Date is: ".$date;
$_SESSION['date'] = $date;
echo"<br>";
$sql = mysql_query("SELECT `date`, `time`, `available`, `name`, `location` FROM `advisor_table`");

//arrays to keep track of the available times for each advisor
$ad1Array = [];
//$ad1DateArray = [];
$ad2Array = [];
//$ad2DateArray = [];
$ad3Array = [];
//$ad3DateArray = [];
$ad4Array = [];
//$ad4DateArray = [];

//Day and month in the database                                
$dayD;
$monthD;

//Day and month of user input
$dayU = substr($date, 3, -5);
$monthU = substr($date, 0, -8);
  

/***************
Here's how my logic works below:
1. The times are put into the table in military time, so that you know which is am and which is pm.
2. Determine if the user selected a specific date.
3. If the user picked a specific date, then pull only those dates from the database where the appoinment is available ("T") and where the name isn't "Group".
4. Otherwise, pull all avaliable dates for each advisor. 
5. The day of the month and the month (both numerical) are placed at the beginning of a string. 
6. Then a decimal is placed, and the time in military time is added after the decimal.
7. Add the string to the array for the advisor it was pulled from.
The date.time format is so that the arrays can be sorted by date and then by time. That way, when they appear on the screen, they will be in order of date and time of the next available appointments. 
 ***************/

while($row = mysql_fetch_array($sql)) {
  if($row["available"] == "T" and $row["name"] != "Group") {
    //if the user selected a date
    if($date != "") {
      //get the date and month from the database.
      $dayD = substr($row["date"], -2);
      $monthD = substr($row["date"], 5, -3);
      //if it matches, determine which advisor it is
      if($dayD == $dayU and $monthD == $monthU) {
	if($row["name"] == "Advisor 1" or $row["name"] == "Advisor1") {
	  //make the time string into MMDD.hhmm (military time)
	  $time = $monthD . $dayD;
	  $time .= ".";
	  $time .= $row["time"];
	  $ad1Array[] = $time;
	}
	else if($row["name"] == "Advisor 2" or $row["name"] == "Advisor2") {
	  //make the time string into MMDD.hhmm (military time)
	  $time = $monthD . $dayD;
	  $time .= ".";
	  $time .= $row["time"];
	  $ad2Array[] = $time;
	}
	else if($row["name"] == "Advisor 3" or $row["name"] == "Advisor3") {
	  //make the time string into MMDD.hhmm (military time)
	  $time = $monthD . $dayD;
	  $time .= ".";
	  $time .= $row["time"];
	  $ad3Array[] = $time;
	}
	else if($row["name"] == "Advisor 4" or $row["name"] == "Advisor4") {
	  //make the time string into MMDD.hhmm (military time)
	  $time = $monthD . $dayD;
	  $time .= ".";
	  $time .= $row["time"];
	  $ad4Array[] = $time;
	}
      }
    }
    else{
      //get the date and month from the database.
      $monthD = substr($row["date"], 5, -3);
      $dayD = substr($row["date"], -2);
      if($row["name"] == "Advisor 1" or $row["name"] == "Advisor1") {	
	//make the time string into MMDD.hhmm (military time)
	$time = $monthD . $dayD;
	$time .= ".";
	$time .= $row["time"];
	$ad1Array[] = $time;
      }
      else if($row["name"] == "Advisor 2" or $row["name"] == "Advisor2") {
	//make the time string into MMDD.hhmm (military time)
	$time = $monthD . $dayD;
	$time .= ".";
	$time .= $row["time"];
	$ad2Array[] = $time;
      }
      else if($row["name"] == "Advisor 3" or $row["name"] == "Advisor3") {
	//make the time string into MMDD.hhmm (military time)
       	$time = $monthD . $dayD;
	$time .= ".";
	$time .= $row["time"];
	$ad3Array[] = $time;
      }
      else if($row["name"] == "Advisor 4" or $row["name"] == "Advisor4") {
	//make the time string into MMDD.hhmm (military time)
       	$time = $monthD . $dayD;
	$time .= ".";
	$time .= $row["time"];
	$ad4Array[] = $time;
      }
    }
  }
}

//Get the size of each array. 
/**********
Here's how my logic works (for each advisor):
1. Get size for all of advisor 1's available appointments
2. If the size is bigger than or equal to 1 (basically if it has something), print out the radio button, the time and date to the corresponding button
4. Subtract one from that total
5. Repeat until the total is 0
6. Once the total is 0, or if it hits 16, then it stops printing out available times.
*************/

sort($ad1Array);
$total1 = count($ad1Array);
//print_r($ad1Array);
sort($ad2Array);
$total2 = count($ad2Array);
//print_r($ad2Array);
sort($ad3Array);
$total3 = count($ad3Array);
//print_r($ad3Array);
sort($ad4Array);
$total4 = count($ad4Array);
//print_r($ad4Array);

/* Here I have made a table so that the 4 advisors are displayed along the top and their avaliable times are displayed below. Listed are the next 16 availiable times for each advisor, or if user picks date, show all advisors available times for that date.
 */

echo"<table style='width:100%' align='left'>";
echo"<tr>";
echo"<th>Advisor 1</th>";
echo"<th>Advisor 2</th>";
echo"<th>Advisor 3</th>";
echo"<th>Advisor 4</th>";
echo"</tr>";
echo"<tbody>";
echo"<form action='indiv.php' method='post' name='form2'>";
echo"<tr>";

//Row 1
if($total1 >= 1) {
  $timeVal = $ad1Array[0]. "ad1";
  $value = myTime($ad1Array[0]);
  $value .= "\t".myDate($ad1Array[0]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[0] . "ad2";
  $value = myTime($ad2Array[0]);
  $value .= " ". myDate($ad2Array[0]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[0] . "ad3";
  $value = myTime($ad3Array[0]);
  $value .= " ". myDate($ad3Array[0]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[0] . "ad4";
  $value = myTime($ad4Array[0]);
  $value .= " ". myDate($ad4Array[0]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 2
if($total1 >= 1) {
  $timeVal = $ad1Array[1]. "ad1";
  $value = myTime($ad1Array[1]);
  $value .= "\t".myDate($ad1Array[1]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[1] . "ad2";
  $value = myTime($ad2Array[1]);
  $value .= "\t".myDate($ad2Array[1]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[1] . "ad3";
  $value = myTime($ad3Array[1]);
  $value .= "\t".myDate($ad3Array[1]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[1] . "ad4";
  $value = myTime($ad4Array[1]);
  $value .= "\t".myDate($ad4Array[1]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 3
if($total1 >= 1) {
  $timeVal = $ad1Array[2]. "ad1";
  $value = myTime($ad1Array[2]);
  $value .= "\t".myDate($ad1Array[2]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[2] . "ad2";
  $value = myTime($ad2Array[2]);
  $value .= "\t".myDate($ad2Array[2]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[2] . "ad3";
  $value = myTime($ad3Array[2]);
  $value .= "\t".myDate($ad3Array[2]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[2] . "ad4";
  $value = myTime($ad4Array[2]);
 $value .= "\t".myDate($ad4Array[2]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 4
if($total1 >= 1) {
  $timeVal = $ad1Array[3]. "ad1";
  $value = myTime($ad1Array[3]);
  $value .= "\t".myDate($ad1Array[3]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[3] . "ad2";
  $value = myTime($ad2Array[3]);
  $value .= "\t".myDate($ad2Array[3]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[3] . "ad3";
  $value = myTime($ad3Array[3]);
  $value .= "\t".myDate($ad3Array[3]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[3] . "ad4";
  $value = myTime($ad4Array[3]);
  $value .= "\t".myDate($ad4Array[3]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 5
if($total1 >= 1) {
  $timeVal = $ad1Array[4]. "ad1";
  $value = myTime($ad1Array[4]);
  $value .= "\t".myDate($ad1Array[4]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[4] . "ad2";
  $value = myTime($ad2Array[4]);
  $value .= "\t".myDate($ad2Array[4]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[4] . "ad3";
  $value = myTime($ad3Array[4]);
  $value .= "\t".myDate($ad3Array[4]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[4] . "ad4";
  $value = myTime($ad4Array[4]);
  $value .= "\t".myDate($ad4Array[4]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 6
if($total1 >= 1) {
  $timeVal = $ad1Array[5]. "ad1";
  $value = myTime($ad1Array[5]);
  $value .= "\t".myDate($ad1Array[5]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[5] . "ad2";
  $value = myTime($ad2Array[5]);
  $value .= "\t".myDate($ad2Array[5]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[5] . "ad3";
  $value = myTime($ad3Array[5]);
  $value .= "\t".myDate($ad3Array[5]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[5] . "ad4";
  $value = myTime($ad4Array[5]);
  $value .= "\t".myDate($ad4Array[5]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 7
if($total1 >= 1) {
  $timeVal = $ad1Array[6]. "ad1";
  $value = myTime($ad1Array[6]);
  $value .= "\t".myDate($ad1Array[6]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[6] . "ad2";
  $value = myTime($ad2Array[6]);
  $value .= "\t".myDate($ad2Array[6]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[6] . "ad3";
  $value = myTime($ad3Array[6]);
  $value .= "\t".myDate($ad3Array[6]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[6] . "ad4";
  $value = myTime($ad4Array[6]);
  $value .= "\t".myDate($ad4Array[6]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 8
if($total1 >= 1) {
  $timeVal = $ad1Array[7]. "ad1";
  $value = myTime($ad1Array[7]);
  $value .= "\t".myDate($ad1Array[7]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[7] . "ad2";
  $value = myTime($ad2Array[7]);
  $value .= "\t".myDate($ad2Array[7]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[7] . "ad3";
  $value = myTime($ad3Array[7]);
  $value .= "\t".myDate($ad3Array[7]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[7] . "ad4";
  $value = myTime($ad4Array[7]);
  $value .= "\t".myDate($ad4Array[7]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 9
if($total1 >= 1) {
  $timeVal = $ad1Array[8]. "ad1";
  $value = myTime($ad1Array[8]);
  $value .= "\t".myDate($ad1Array[8]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[8] . "ad2";
  $value = myTime($ad2Array[8]);
  $value .= "\t".myDate($ad2Array[8]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[8] . "ad3";
  $value = myTime($ad3Array[8]);
  $value .= "\t".myDate($ad3Array[8]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[8] . "ad4";
  $value = myTime($ad4Array[8]);
  $value .= "\t".myDate($ad4Array[8]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 10
if($total1 >= 1) {
  $timeVal = $ad1Array[9]. "ad1";
  $value = myTime($ad1Array[9]);
  $value .= "\t".myDate($ad1Array[9]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[9] . "ad2";
  $value = myTime($ad2Array[9]);
  $value .= "\t".myDate($ad2Array[9]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[9] . "ad3";
  $value = myTime($ad3Array[9]);
  $value .= "\t".myDate($ad3Array[9]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[9] . "ad4";
  $value = myTime($ad4Array[9]);
  $value .= "\t".myDate($ad4Array[9]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 11
if($total1 >= 1) {
  $timeVal = $ad1Array[10]. "ad1";
  $value = myTime($ad1Array[10]);
  $value .= "\t".myDate($ad1Array[10]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[10] . "ad2";
  $value = myTime($ad2Array[10]);
  $value .= "\t".myDate($ad2Array[10]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[10] . "ad3";
  $value = myTime($ad3Array[10]);
  $value .= "\t".myDate($ad3Array[10]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[10] . "ad4";
  $value = myTime($ad4Array[10]);
  $value .= "\t".myDate($ad4Array[10]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 12
if($total1 >= 1) {
  $timeVal = $ad1Array[11]. "ad1";
  $value = myTime($ad1Array[11]);
  $value .= "\t".myDate($ad1Array[11]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[11] . "ad2";
  $value = myTime($ad2Array[11]);
  $value .= "\t".myDate($ad2Array[11]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[11] . "ad3";
  $value = myTime($ad3Array[11]);
  $value .= "\t".myDate($ad3Array[11]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[11] . "ad4";
  $value = myTime($ad4Array[11]);
  $value .= "\t".myDate($ad4Array[11]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 13
if($total1 >= 1) {
  $timeVal = $ad1Array[12]. "ad1";
  $value = myTime($ad1Array[12]);
  $value .= "\t".myDate($ad1Array[12]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[12] . "ad2";
  $value = myTime($ad2Array[12]);
  $value .= "\t".myDate($ad2Array[12]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[12] . "ad3";
  $value = myTime($ad3Array[12]);
  $value .= "\t".myDate($ad3Array[12]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[12] . "ad4";
  $value = myTime($ad4Array[12]);
  $value .= "\t".myDate($ad4Array[12]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 14
if($total1 >= 1) {
  $timeVal = $ad1Array[13]. "ad1";
  $value = myTime($ad1Array[13]);
  $value .= "\t".myDate($ad1Array[13]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[13] . "ad2";
  $value = myTime($ad2Array[13]);
  $value .= "\t".myDate($ad2Array[13]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[13] . "ad3";
  $value = myTime($ad3Array[13]);
  $value .= "\t".myDate($ad3Array[13]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[13] . "ad4";
  $value = myTime($ad4Array[13]);
  $value .= "\t".myDate($ad4Array[13]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 15
if($total1 >= 1) {
  $timeVal = $ad1Array[14]. "ad1";
  $value = myTime($ad1Array[14]);
  $value .= "\t".myDate($ad1Array[14]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[14] . "ad2";
  $value = myTime($ad2Array[14]);
  $value .= "\t".myDate($ad2Array[14]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[14] . "ad3";
  $value = myTime($ad3Array[14]);
  $value .= "\t".myDate($ad3Array[14]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[14] . "ad4";
  $value = myTime($ad4Array[14]);
  $value .= "\t".myDate($ad4Array[14]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

//Row 16
if($total1 >= 1) {
  $timeVal = $ad1Array[15]. "ad1";
  $value = myTime($ad1Array[15]);
  $value .= "\t".myDate($ad1Array[15]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value </td>";
$total1 -= 1;
}
if($total2 >= 1) {
  $timeVal = $ad2Array[15] . "ad2";
  $value = myTime($ad2Array[15]);
  $value .= "\t".myDate($ad2Array[15]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total2 -= 1;
}
if($total3 >= 1) {
  $timeVal = $ad3Array[15] . "ad3";
  $value = myTime($ad3Array[15]);
  $value .= "\t".myDate($ad3Array[15]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total3 -= 1;
}
if($total4 >= 1) {
  $timeVal = $ad4Array[15] . "ad4";
  $value = myTime($ad4Array[15]);
  $value .= "\t".myDate($ad4Array[15]);
echo"<td><input type='radio' name='appointment' value=$timeVal>$value</td>";
$total4 -= 1;
}
echo"</tr>";

echo"<tr>";
echo"<td></td>";
echo"<td></td>";
echo"<td><input type='submit'></td>";
echo"</tr>";
echo"</form>";
echo"</tbody>";
echo"</table>";

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