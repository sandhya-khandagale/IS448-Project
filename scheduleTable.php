<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Schedule</title>
    <link rel="stylesheet" type="text/css" href="main_stylesheet.css" />
    <script>
        //JavaScript Function

        function hideRowsWithValue(value) {
            var table = document.getElementById("myTable");
            var rows = table.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
                var cells = rows[i].getElementsByTagName("td");

            
                var cellValue = cells[3].textContent;
                if(value == "all"){
                    rows[i].style.display = ""
                }else if (cellValue === value) {
                    rows[i].style.display = ""; // unhide the row
                } else {
                    rows[i].style.display = "none"; // Hide the row
                }
            }
        }   

        function filterStandings() {
            var selectedSport = document.getElementById("sportSelector").value;
            hideRowsWithValue(selectedSport)
        }
    </script>

    
</head>
<body>
    <?php
        $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "dabimbo1", "dabimbo1", "dabimbo1");

        $sql = "SELECT Dates, HOME, AWAY, Sport FROM Games";
        $result = mysqli_query($db, $sql);


    ?>
    <h1>Schedule of Games </h1>


    <div class = "button-center">

    <label  for ="sportSelector"> Select Sport To Filter: </label>
    <select  id="sportSelector" onchange="filterStandings()">
        <option value="all">All Sports</option>
        <?php
        // Fetching distinct sports from the database
        $sports_query = "SELECT DISTINCT Sport FROM Games";
        $sports_result = mysqli_query($db, $sports_query);

        if ($sports_result) {
            while ($sport_row = mysqli_fetch_assoc($sports_result)) {
                echo "<option value='{$sport_row['Sport']}'>{$sport_row['Sport']}</option>";
            }
        }
        ?>
    </select>
    <br>
    <br>
        <table id="myTable" >
            <tr>
                <th>Date</th>
                <th>Home Team</th>
                <th>Away Team</th>
                <th>Sport</th>
            </tr>
            <?php
            // Loop through the results and populate the table
            while ($row = $result->fetch_assoc()) {
                echo "<tr id = 'row' >";
                echo "<td >" . $row['Dates'] . "</td>";
                echo "<td>" . $row['HOME'] . "</td>";
                echo "<td>" . $row['AWAY'] . "</td>";
                echo "<td id = '{$row['Sport']}'>" . $row['Sport'] . "</td>";
                echo "</tr>";
            }
            
            // Close the result set and connection
            $result->close();
            
            ?>
            
        </table>
        <br>
        <br>
        <a href = "dashboard.html"> Dashboard </a>
        </div>

</body>
</html>

