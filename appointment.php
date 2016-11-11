<?php
  //Get the button
$button = ($_POST['button']);
echo($button);

if($button == "group") {
  //Head over to the group page
  header('location:group1.php');
}

else if($button == "indiv") {
  //Head on over to an individual appointment
  header('location:individual.php');
}
?>