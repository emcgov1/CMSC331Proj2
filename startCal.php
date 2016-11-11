<?php
  session_start();

  // redirect user if not logged in
  if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header("Location: advisorCrea.html");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Calendar</title>
    
    <link rel="icon" type="image/x-icon" href="favicon.png"/>
    <link rel="stylesheet" type="text/css" href="calendar.css"/>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
  </head>

  <body>
    <form action='calendar.php' method='post' name='displayDate'>
      <div style="float:left; width:25%;">
	<header>
	  <input type="submit" value="«" style="float:left;">
	  <input type="submit" value="»" style="float:right; text-align:left;">
	  <h2>November 2016</h2>
	</header>
	<table>
	  <tr>
	    <td>S</td>
	    <td>M</td>
	    <td>T</td>
	    <td>W</td>
	    <td>Th</td>
	    <td>F</td>
	    <td>S</td>
	  </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td><input type="submit" name="selDate" value="1"></td>
	    <td><input type="submit" name="selDate" value="2"></td>
	    <td><input type="submit" value="3" name="selDate"></td>
	    <td><input type="submit" value="4" name="selDate" ></td>
	    <td><input type="submit" value="5" name="selDate" ></td>
	  </tr>
	  <tr>
	    <td><input type="submit" value="6" name="selDate"></td>
	    <td><input type="submit" value="7" name="selDate"></td>
	    <td><input type="submit" value="8" name="selDate"></td>
	    <td><input type="submit" value="9" name="selDate"></td>
	    <td><input type="submit" value="10" name="selDate"></td>
	    <td><input type="submit" value="11" name="selDate"></td>
	    <td><input type="submit" value="12" name="selDate"></td>
	  </tr>
	  <tr>
	    <td><input type="submit" value="13" name="selDate"></td>
	    <td><input type="submit" value="14" name="selDate"></td>
	    <td><input type="submit" value="15" name="selDate"></td>
	    <td><input type="submit" value="16" name="selDate"></td>
	    <td><input type="submit" value="17" name="selDate"></td>
	    <td><input type="submit" value="18" name="selDate"></td>
	    <td><input type="submit" value="19" name="selDate"></td>
	  </tr>
	  <tr>
	    <td><input type="submit" value="20" name="selDate"></td>
	    <td><input type="submit" value="21" name="selDate"></td>
	    <td><input type="submit" value="22" name="selDate"></td>
	    <td><input type="submit" value="23" name="selDate"></td>
	    <td><input type="submit" value="24" name="selDate"></td>
	    <td><input type="submit" value="25" name="selDate"></td>
	    <td><input type="submit" value="26" name="selDate"></td>
	  </tr>
	  <tr>
	    <td><input type="submit" value="27" name="selDate"></td>
	    <td><input type="submit" value="28" name="selDate"></td>
	    <td><input type="submit" value="29" name="selDate"></td>
	    <td><input type="submit" value="30" name="selDate"></td>
	    <td></td>
	    <td></td>
	    <td></td>
	  </tr>
	</table>
      </div>
      
    </form>
      <div style="float:left; width:70%;">
	Select date using calendar on the left
	<!--	   <h1>In new page!</h1> 
      </div>
    </form>
  </body>
</html>
-->

