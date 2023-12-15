<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">


<html xmlns = "http://www.w3.org/1999/xhtml">
<head> 
    <title>Choose team</title>
    <link rel="stylesheet" type = "text/css" href="main_stylesheet.css">
</head>
<body>
<?php
  //Connect to database
  $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "dabimbo1", "dabimbo1", "dabimbo1");
  if(mysqli_error($db)) {
  die("error: " . mysqli_error($db));
  }

  //collecting form inputs
  $teamname =  htmlspecialchars($_POST["teamname"]);

  $teamname = mysqli_real_escape_string($db,$teamname);

  // Check to see if team exists
  $first_query = "SELECT Teamname from Teams where Teamname = '$teamname'";

  //execute query
  $result = mysqli_query($db, $first_query);

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['Teamname'] === $teamname ){
?>

<h1> Success </h1>


<p> You have successfully submitted a request to join <?php echo $teamname ?> </p>
<br>
<br>
<p> <a href = "leaguepage.html" > Account </a> </p>

<?php

    }else{
      ?>

<h1> Invalid Teamname </h1>

<p> Team <?php  echo $teamname?>  does not exists. Pls choose an existing team to join.</p>
<br>
<br>
<p> <a href = "jointeam.html" > Go back and input correct team name </a> </p>

<?php



    }
  }else{
?>

<h1> Invalid Teamname </h1>

<p> Team <?php  echo $teamname?>  does not exists. Pls choose an existing team to join.</p>
<br>
<br>
<p> <a href = "jointeam.html" > Go back and input correct team name </a> </p>

<?php
    }
  
?>

</body>
</html>