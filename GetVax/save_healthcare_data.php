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
    if (checkEmpty($centre_name) and checkEmpty($address))
    {   
        $check_exist = "SELECT * FROM healthcare_centre where centreName = '".$centre_name."'";
        $res = mysqli_query($conn,$check_exist);
        $count = mysqli_num_rows($res);
        if($count == 0){
            $query="INSERT INTO healthcare_centre (centreName, address) VALUES ('$centre_name', '$address')";
            $sql=mysqli_query($conn,$query)or die(mysqli_error($conn));
            header("refresh:1; url=signup.php");
            echo '<script>alert("New Healthcare Center Created!")</script>';
        }else{
            header("refresh:1; url=signup.php");
            echo '<script>alert("Centre Name already exist!")</script>';
        }
        

    }
    else{
        header("refresh:1; url=signup.php");
        echo '<script>alert("Please fill the form!")</script>';
    }
}
?>
