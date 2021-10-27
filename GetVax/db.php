<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dataBaseName = "getvax";

$conn = mysqli_connect($serverName,$userName,$password,$dataBaseName);

if (!$conn){
    die ("Error: ".mysqli_connect_error());
}?>
