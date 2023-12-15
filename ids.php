<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">


<html xmlns = "http://www.w3.org/1999/xhtml">
<head> 
    <title>Choose team</title>
    <link rel="stylesheet" type = "text/css" href="main_stylesheet.css">
</head>
<body>
	<?php
$arr[]="KT35450";
$arr[]="WA55970";
$arr[]="KD16892";
$arr[]="LJ95576";
$arr[]="BE01250";
$arr[]="kt35450";
$arr[]="wa55970";
$arr[]="kd16892";
$arr[]="lj95576";
$arr[]="be01250";

$q=$_GET["name"];

if (in_array($q,$arr))
{
	$response="taken";
}
else{
	$response = "available";
}
echo $response;