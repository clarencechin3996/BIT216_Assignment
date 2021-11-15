<?php
require_once 'db.php';
session_start();
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
        echo '<script>alert("Please fill the form!")</script>';
    }else{
        $query = "SELECT * FROM batch where batchNo = '".$availableBatches."'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);

        if($appointmentDate < $row['expiryDate']){

             /*$pending = $row['numberOfPendingAppointment'];
             $new_pending = $pending + 1;
             $query2 = "UPDATE batch set numberOfPendingAppointment = '".$new_pending."' where batchNo = '".$availableBatches."'";
             $sql2=mysqli_query($conn,$query2)or die(mysqli_error($conn));*/

             $userId = $_SESSION['userID'];
             $query="INSERT INTO vaccination (appointmentDate, userID,batchNo) VALUES ('$appointmentDate', '$userId' ,'$availableBatches')";
             $sql=mysqli_query($conn,$query)or die(mysqli_error($conn));
             header("refresh:1; url=requestVaccinationAppointment.php");
             echo '<script>alert("Appoinment Created!")</script>';

        }else{
            header("refresh:1; url=requestVaccinationAppointment.php");
             echo '<script>alert("Select other appointment Date")</script>';
        }
    }
}
?>
