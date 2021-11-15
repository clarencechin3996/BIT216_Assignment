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
session_start();
$name = $_SESSION["username"];
$sql = "SELECT * FROM administrator WHERE username = '$name';";
$result = $conn->query($sql);

while ($row = mysqli_fetch_assoc($result)) {
  $hc = $row['healthcarecenters'];
}
if (isset($_POST)){
    extract($_POST);

    if (checkEmpty($VaccineList) and checkEmpty($batchNumber) and checkEmpty($exp_date) and checkEmpty($doses))
    {

        $check_exist = "SELECT * FROM batch where batchNo = '".$batchNumber."'";
        $res = mysqli_query($conn,$check_exist);
        $count = mysqli_num_rows($res);
        if($count == 0){
       
            $q = "set FOREIGN_KEY_CHECKS=0;";
            $sq = mysqli_query($conn,$q)or die(mysqli_error($conn));
            $query="INSERT INTO batch (batchNo, expiryDate, quantityAvailable, vaccineID, centreName) VALUES ('$batchNumber', '$exp_date', '$doses', '$VaccineList', '$hc')";
            $sql=mysqli_query($conn,$query)or die(mysqli_error($conn));
            header("refresh:1; url=recordVaccinationBatch.php");
            echo '<script>alert("New Vaccination Batch Created!")</script>';
        }else{
            header("refresh:1; url=recordVaccinationBatch.php");
            echo '<script>alert("Batch Number Exist!")</script>';
        }

        
    }
    else{
        header("refresh:1; url=recordVaccinationBatch.php");
        echo '<script>alert("Please fill the form!")</script>';
    }
}
