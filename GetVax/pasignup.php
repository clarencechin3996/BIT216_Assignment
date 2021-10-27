<?php
require_once 'db.php';

function checkEmpty($var){
    if (empty($var)){
        return false;
    }
    else {
        return true;
    }
}

if (isset($_POST)){
    extract($_POST);
    if ( checkEmpty($username) and checkEmpty($pass) and checkEmpty($ic) )
    {
        $query="INSERT INTO patient (username, pass, ic) VALUES ( '$username', '$pass', '$ic')";
        $sql=mysqli_query($conn,$query)or die(mysqli_error($conn));
        header("refresh:1; url=login.html");
        echo '<script>alert("Patient Account Created!")</script>';
    }
    else{
        header("refresh:1; url=signup.html");
        echo '<script>alert("Please fill the form!")</script>';
    }


}
?>
