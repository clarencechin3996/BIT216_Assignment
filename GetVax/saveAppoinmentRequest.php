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
    if($vaccineList == 'none' || $healthcareCenters == 'none' || $availableBatches == 'none'){
        header("refresh:1; url=requestVaccinationAppointment.php");
       // echo '<script>alert("Please fill the form!")</script>';
    }else{
        $query = "SELECT * FROM batch where batchNo = '".$availableBatches."'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        if($appointmentDate < $row['expiryDate']){
             echo '<script>alert("New Vaccine Created!")</script>';
        }else{
             echo '<script>alert("New Vaccine Created2!")</script>';
        }
    }

    /*if (checkEmpty($manufacturer) and checkEmpty($vaccine_name))
    {
        $query="INSERT INTO vaccine (manufacturer, vaccineName) VALUES ('$manufacturer', '$vaccine_name')";
        $sql=mysqli_query($conn,$query)or die(mysqli_error($conn));
        header("refresh:1; url=recordVaccineData.html");
        echo '<script>alert("New Vaccine Created!")</script>';
    }
    else{
        header("refresh:1; url=recordVaccineData.html");
        echo '<script>alert("Please fill the form!")</script>';
    }*/
}
?>
