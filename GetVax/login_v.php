<?php
require_once 'db.php';
session_start();

if(isset($_POST))
{
    extract($_POST);
    $sql=mysqli_query($conn,"SELECT * FROM administrator where pass='$pass' and username='$username'");
    $row  = mysqli_fetch_array($sql);
    
    if(is_array($row)) //check if there is a vlue in the array ROW
    // we can use if (empty) to check if there no element on the array ROW
    {
      $_SESSION["username"]=$username;
     
      header("refresh:1; url=adminHome.php");
      echo '<script>alert("Successfully Logged in as Healthcare Administrator")</script>';


    }

    else{

    $sql=mysqli_query($conn,"SELECT * FROM patient where pass='$pass' and username='$username'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row)) //check if there is a vlue in the array ROW
    // we can use if (empty) to check if there no element on the array ROW
    {
      $_SESSION["username"]=$username;
      header("refresh:1; url=patientHome.php");
      echo '<script>alert("Successfully Logged in as Patient")</script>';


    }

    else {
        header("refresh:1; url=login.html");
        echo '<script>alert("Invalid Username Or Password")</script>';
    }
    }
}
?>
