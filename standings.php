<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Team Standings</title>
    <link rel="stylesheet" type="text/css" href="main_stylesheet.css">

    <script>
        //JavaScript Function
        function filterStandings() {
            var selectedSport = document.getElementById("sportSelector").value;
            console.log(selectedSport);

            // Hide all tables initially
            var tables = document.getElementsByTagName("table");
            console.log(tables);

            if(selectedSport !== "all"){
                for (var i = 0; i < tables.length; i++) {
                tables[i].style.display = "none";
                }
            }
            

            // Showing the table for the selected sport by the user
            if(selectedSport !== "all"){
                var selectedTable = document.getElementById(selectedSport + "Table");
                if (selectedTable) {
                    selectedTable.style.display = "table";
                }
            }else{
                for (var i = 0; i < tables.length; i++) {
                tables[i].style.display = "table";
                }
            }
        }
    </script>
</head>

<body>
    
<?php
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "dabimbo1", "dabimbo1", "dabimbo1");

    // Checking if the connection is successful
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetching teams and their standings from the database, grouped by Sport
    $standings_query = "SELECT Teamname, Sport, Score FROM Teams ORDER BY Sport, Score DESC";
    $standings_result = mysqli_query($db, $standings_query);

    // Checking if the query is successful
    if (!$standings_result) {
        die("Query failed: " . mysqli_error($db));
    }
    ?>

    <h1>Team Standings</h1>
    <div class = "button-center">

    <label for="sportSelector">Select Sport:</label>

    <select id="sportSelector" onchange="filterStandings()">
        <option value="all">All Sports</option>

        <?php
        
        // Fetching distinct sports from the database
        $sports_query = "SELECT DISTINCT Sport FROM Teams";
        $sports_result = mysqli_query($db, $sports_query);

        if ($sports_result) {
            while ($sport_row = mysqli_fetch_assoc($sports_result)) {
                echo "<option value='{$sport_row['Sport']}'>{$sport_row['Sport']}</option>";
            }
        }
        ?>
    </select>

    <?php
    $currentSport = null;

    
       // Resetting the internal data
       mysqli_data_seek($standings_result, 0);

       while ($row = mysqli_fetch_assoc($standings_result)) {
           if ($row['Sport'] !== $currentSport) {
               if ($currentSport !== null) {
                   echo "</table>";
               }
   
               echo "<h3>{$row['Sport']} Standings</h3>";
               echo "<table id='{$row['Sport']}Table'>";
               echo "<tr>
                       <th>Team</th>
                       <th>Sport</th>
                       <th>Score</th>
                   </tr>";
   
               $currentSport = $row['Sport'];
           }
   
           echo "<tr>
                   <td>{$row['Teamname']}</td>
                   <td>{$row['Sport']}</td>
                   <td>{$row['Score']}</td>
               </tr>";
       }
   
       echo "</table>";
   ?>
    
    <br>
    <br>
    <a href="dashboard.html">Go to Account</a>
    </div>
</body>
</html>
