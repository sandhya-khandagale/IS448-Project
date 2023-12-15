<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">


<html xmlns = "http://www.w3.org/1999/xhtml">
<head> 
    <title>New Team</title>
    <link rel="stylesheet" type = "text/css" href="main_stylesheet.css">
</head>
<body>
    <?php
        //Connect to database
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "dabimbo1", "dabimbo1", "dabimbo1");
        if(mysqli_error($db)) {
           die("error: " . mysqli_error($db));
        }
        
        //collecting form inputs and put all html variable into php viarables
        $teamname =  htmlspecialchars($_POST["name"]);
        $teamnumber =  htmlspecialchars($_POST["players"]);
        $sport =  htmlspecialchars($_POST["sport"]);

        $teamname = mysqli_real_escape_string($db,$teamname);
        $teamnumber = mysqli_real_escape_string($db,$teamnumber);
        $sport = mysqli_real_escape_string($db,$sport);

        
        // Check to see if teamname has been chosen
        $first_query = "SELECT Teamname from Teams where Teamname = '$teamname'";

        //execute query
        $first_results = mysqli_query($db, $first_query);
        
        //query results
        $array = mysqli_fetch_assoc($first_results);
        
        
        //if statement to check teamname
        if($array['Teamname'] === $teamname){
            ?>
            <h1> Invalid Teamname </h1>
            <div class = "button-center">
			<p> Unavailable Teamname! </p>
            <p> Enter Valid Teamname </P>
            <br>
            <br>
            <a href = "Createteam.html"> Create Team </a>
            </div>
			<?php
        }else{
        
        //create my SQL query
        //more columns might added but basic info for now
        //intern into team table
        $constrcuted_query = "INSERT INTO Teams(Teamname, Numberofplayers, Score, Sport) VALUES('$teamname', '$teamnumber', 0, '$sport')" ;

        //execute SQL query
        $results = mysqli_query($db, $constrcuted_query);


        ?>
        <h1> Congratulationas! </h1>
        <p> Your team <?php echo $teamname ?> 
         has been added to team roster with <?php echo $teamnumber ?> 
         number of players for <?php echo $sport  ?> <p>
        <br>
        <br>

        <a href = "leaguepage.html">
        Account page
        </a>

        <?php
        }
    ?>
        
            

</body>
</html>