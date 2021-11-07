<?php
session_start()
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "getvax");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
global $var;
$vac = $_SESSION["VACID"];
$batNo = $_SESSION["BATCHNO"];

$sql = "SELECT * FROM vaccination WHERE vaccinationID = '$vac'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["status_s"] === "CONFIRMED") {
            echo '<script type="text/javascript">';
            echo 'alert("Appointment had already been confirmed!");';
            echo 'window.location = "vaccineBatchInfo.php";';
            echo '</script>';
        } else {
            $sql = "UPDATE vaccination SET status_s = 'CONFIRMED' WHERE vaccinationID = '$vac'";
            if ($conn->query($sql) === TRUE) {
                $sql = "UPDATE batch SET numberOfPendingAppointment = numberOfPendingAppointment + 1 WHERE batchNo = '$batNo'";
                $conn->query($sql);
            } else {
                echo "Error updating record: " . $conn->error;
            }
            echo '<script type="text/javascript">';
            echo 'alert("Appointment Confirmed!");';
            echo 'window.location = "vaccineBatchInfo.php";';
            echo '</script>';
        }
    }
}else{
    echo "No data"; //Display none error
}

?>