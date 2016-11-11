<?php
  session_start();
  // redirect user if not logged in
  if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header("Location: login.html");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advising Scheduling</title>
    <link rel="icon" type="image/x-icon" href="favicon.png"/>
    <link rel="stylesheet" type="text/css" href="student.css"/>
  <title>Cancel Appointment</title>
</head>

<body>

<h1>Are you sure you want to cancel your appointment?</h1>
  <div class='cancel'>
  <form action='cancel.php' method='post'>
    <input type='submit' id='button' name='choice' value='YES'>
    <br><br>
    <input type='submit' id='button' name='choice' value='NO'>
  </form>
</div>

</body>
</html>
