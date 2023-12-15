<!DOCTYPE html>
<html>
<head>
  <title>Sign Up Validation</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="main_stylesheet.css" />
</head>
<body>
    <h1>Sign Up Validation</h1>
  <div class = "button-center">
    <?php

        //will be connected to database...
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu","skhanda1","skhanda1","skhanda1");
        if (mysqli_connect_errno()){
        exit("Error - could not connect to MySQL");}

        //hmtl injection
        $firstName = htmlspecialchars($_POST["firstName"]);
        $lastName = htmlspecialchars($_POST["lastName"]);
        $email = htmlspecialchars($_POST["email"]);
        $campusID = htmlspecialchars($_POST["campusID"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        //mysql injection
        $firstName = mysqli_real_escape_string($db, $firstName);
        $lastName = mysqli_real_escape_string($db, $lastName);
        $email = mysqli_real_escape_string($db, $email);
        $campusID = mysqli_real_escape_string($db, $campusID);
        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db,$password);

        //check if campus id is valid
        if (preg_match("/[A-Za-z]{2}+\d{5}+/x", $campusID)) {
            echo "<p> Campus ID was in correct format </p> <br />";


          $z = 0;
          //check is username exists
          $username_query = "SELECT username from newUser";

          //execute SQL query
          $results = mysqli_query($db, $username_query);

          while($row = mysqli_fetch_assoc($results)){
            if($username === $row['username']){
              $z = 1;
            }
            
          }
          
          if($z == 0){
            
          //sql query
          $constructed_query = "INSERT INTO newUser(firstName, lastName, email, campusID, username, passwords ) VALUES('$firstName', '$lastName', '$email', '$campusID' , '$username', '$password')";
          
          //execute SQL query
          $insert = mysqli_query($db, $constructed_query);

          
          if(mysqli_error($db)) {
            die("Error: " .mysqli_error($db));
          }
          else {
            echo "<p> New User Created </p>";
          }

          ?>
        <br>
          <br>
          <div class = "button-center">
          <a href = "Enterteam.html"> Join Team </a>
          <?php
          }else{
            echo nl2br("<p> Invalid Username </p> \n \n");
            echo '<a href="signup.html"> Go back and re-enter username. </a> <br />';
        }  
        }else{
            echo nl2br("<p> Invalid Campus ID </p> \n \n");
            echo '<a href="signup.html"> Go back and re-enter Campus ID. </a> <br />';
        }

        ?>
        </div>
</body>
</html>