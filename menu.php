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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advising Scheduling</title>

    <link rel="icon" type="image/x-icon" href="favicon.png"/>
    <link rel="stylesheet" type="text/css" href="student.css"/>
  </head>

  <body>
    <div class="form">
      <h2>Hello</h2>
      <form action="processMenu.php" method="post" name="menu">

<?php

if(!isset($_SESSION['hasAppointment'])) {
    echo('Oops! Something went wrong');
    header('login.html');
  }

  // if student has an appointment, show options to view, cancel, or reschedule
if(($_SESSION['hasAppointment'])) {
  include('appointmentOptions.html');
  } 
  // otherwise show option to sign up for an appointment
  else {
    include('signUpOption.html');
  }
?>
	<button type='submit' name='edit' class='button large selection' value='edit'>Edit student information</button>
      </form>

      <div id="logout">
	<a href="logout.php">Logout</a>
      </div>
    </div>
  </body>
</html>
