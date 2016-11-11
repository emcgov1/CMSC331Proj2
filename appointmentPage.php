<?php
  session_start();
  // redirect user if not logged in
  if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header("Location: login.html");
  }
?>

<html>
<head>
  <meta charset="utf8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advising Scheduling</title>
    <link rel="icon" type="image/x-icon" href="favicon.png"/>
    <link rel="stylesheet" type="text/css" href="standard.css"/>
  <title>Appointment</title>
  <link rel="stylesheet" href="standard.css" type="text/css" />
</head>
<body>
 <h1>Appointment Page</h1> 
<div class='cancel'>
  <h3>Choose an appointment type:</h3>
  <form action='appointment.php' method='post' name='form1'>
    <button class="selectb button2" type='submit' name='button' value='group'>Group</button> 
    
    <button class="selectb button2" type='submit' name='button' value='indiv'>Individual</button>
  </form>
</div>
</body>
</html>
