<?php
$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "dabimbo1", "dabimbo1", "dabimbo1");

// Checking if the connection is successful
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

//select Teamnames from database
$query ="SELECT Teamname FROM Teams";

//execute query
$result = mysqli_query($db, $query);

//create array for Teamnames
while ($row = mysqli_fetch_object($result)){
  $a[] = $row->Teamname;
}

//get the q parameter from URL
$q=$_GET["uname"];

//lookup all hints from array if length of q>0
if (strlen($q) > 0)
{
  $hint="";
  for($i = 0; $i < count($a); $i++)
  {
  if (strtolower($q)==strtolower(substr($a[$i],0,strlen($q))))
    {
    if ($hint=="")
      {
         $hint=$a[$i];
      }
    else
      {
         $hint=$hint." , ".$a[$i];
      }
    }
  }
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint == "")
{
   $response = "no suggestion";
}
else
{
   $response = $hint;
}

//output the response
echo $response;
?>


