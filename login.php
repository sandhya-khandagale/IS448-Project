<!DOCTYPE html>
<html>
<head>
  <title>Log In Validation</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="main_stylesheet.css" />
</head>
<body>
  <h1>Log In Validation</h1>
  <?php
  // connecting to database
  session_start();
  $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "skhanda1", "skhanda1", "skhanda1");
  if (mysqli_connect_errno())
    exit("Error - could not connect to mySQL");

  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  $username = mysqli_real_escape_string($db, $username);
  $password = mysqli_real_escape_string($db, $password);

  $constructed_query = "SELECT * FROM newUser WHERE username ='$username' AND password = '$password'";

  $result = mysqli_query($db, $constructed_query);

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['username'] === $username && $row['password'] === $password) {
?>

<p>Successfully logged in!</p>

<p> Welcome! </p>
<br>
<p> <a href="dashboard.html"> dashboard</a></p>

<?php
      $_SESSION['username'] = $username;
    } else {
?>

  <p> Invalid username and/or password. </p>

<?php
    }
  } else {
?>

  <p> Invalid username and/or password.</p>
  
<?php
  }
?>
</body>
</html>