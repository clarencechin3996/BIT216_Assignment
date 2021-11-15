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
    if (checkEmpty($manufacturer) and checkEmpty($vaccine_name))
    {
        $check_exist = "SELECT * FROM vaccine where vaccineName = '".$vaccine_name."'";
        $res = mysqli_query($conn,$check_exist);
        $count = mysqli_num_rows($res);
        if($count == 0){
            $query="INSERT INTO vaccine (manufacturer, vaccineName) VALUES ('$manufacturer', '$vaccine_name')";
            $sql=mysqli_query($conn,$query)or die(mysqli_error($conn));
            header("refresh:1; url=recordVaccineData.php");
            echo '<script>alert("New Vaccine Created!")</script>';
        }else{
            header("refresh:1; url=recordVaccineData.php");
            echo '<script>alert("Vaccine Name Exist!")</script>';
        }
        
    }
    else{
        header("refresh:1; url=recordVaccineData.php");
        echo '<script>alert("Please fill the form!")</script>';
    }
}
?>
