<?php
session_start()
?>

<?php
if (isset($_POST['confirm'])) {
    $conn = mysqli_connect("localhost", "root", "", "getvax");
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }
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
            } else if($row["status_s"] === "REJECTED"){
                echo '<script type="text/javascript">';
                echo 'alert("Appointment cannot be confirm, it has already been REJECTED!");';
                echo 'window.location = "vaccineBatchInfo.php";';
                echo '</script>';
            }else if($row["status_s"] === "ADMINISTERED"){
                echo '<script type="text/javascript">';
                echo 'alert("Appointment cannot be confirm, it has already been ADMINISTERED!");';
                echo 'window.location = "vaccineBatchInfo.php";';
                echo '</script>';
            }else {
                $sql = "UPDATE vaccination SET status_s = 'CONFIRMED' WHERE vaccinationID = '$vac'";
                if ($conn->query($sql) === TRUE) {
                    $sql = "UPDATE batch SET numberOfPendingAppointment = numberOfPendingAppointment - 1 WHERE batchNo = '$batNo'";
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
    } else {
        echo "No data"; //Display none error
    }
} else if (isset($_POST['reject'])) {
    $remark_reject = $_POST['REJECT'];

    $conn = mysqli_connect("localhost", "root", "", "getvax");
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }
    $vac = $_SESSION["VACID"];
    $sql = "SELECT * FROM vaccination WHERE vaccinationID = '$vac'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["status_s"] === "REJECTED") {
                echo '<script type="text/javascript">';
                echo 'alert("Appointment has already been REJECTED!");';
                echo 'window.location = "vaccineBatchInfo.php";';
                echo '</script>';
            } else if($row["status_s"] === "CONFIRMED"){
                echo '<script type="text/javascript">';
                echo 'alert("Appointment cannot be rejected, it has already been CONFIRMED!");';
                echo 'window.location = "vaccineBatchInfo.php";';
                echo '</script>';
            }else if($row["status_s"] === "ADMINISTERED"){
                echo '<script type="text/javascript">';
                echo 'alert("Appointment cannot be rejected, it has already been ADMINISTERED!");';
                echo 'window.location = "vaccineBatchInfo.php";';
                echo '</script>';
            }else {
                $sql = "UPDATE vaccination SET status_s = 'REJECTED', remark = '$remark_reject' WHERE vaccinationID = '$vac'";
                $conn->query($sql);
                echo '<script type="text/javascript">';
                echo 'alert("Appointment REJECTED!");';
                echo 'window.location = "vaccineBatchInfo.php";';
                echo '</script>';
            }
        }
    }
} else if (isset($_POST['record'])) {
    $remark_record = $_POST['RECORD'];
    $conn = mysqli_connect("localhost", "root", "", "getvax");
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }
    $vac = $_SESSION["VACID"];
    $batNo = $_SESSION["BATCHNO"];

    $sql = "SELECT * FROM vaccination WHERE vaccinationID = '$vac'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["status_s"] === "ADMINISTERED") {
                echo '<script type="text/javascript">';
                echo 'alert("Appointment has already been administered!");';
                echo 'window.location = "vaccineBatchInfo.php";';
                echo '</script>';
            }else if($row["status_s"] === "PENDING"){
                echo '<script type="text/javascript">';
                echo 'alert("Appointment cannot be record, it needs to be CONFIRMED!");';
                echo 'window.location = "vaccineBatchInfo.php";';
                echo '</script>';
            } else if($row["status_s"] === "REJECTED"){
                echo '<script type="text/javascript">';
                echo 'alert("Appointment cannot be record, it has already been REJECTED!");';
                echo 'window.location = "vaccineBatchInfo.php";';
                echo '</script>';
            }else {
                $sql = "UPDATE vaccination SET status_s = 'ADMINISTERED', remark = '$remark_record' WHERE vaccinationID = '$vac'";
                if ($conn->query($sql) === TRUE) {
                    $sql = "UPDATE batch SET quantityAdministered = quantityAdministered + 1, quantityAvailable = quantityAvailable - 1 WHERE batchNo = '$batNo'";
                    $conn->query($sql);
                } else {
                    echo "Error updating record: " . $conn->error;
                }
                echo '<script type="text/javascript">';
                echo 'alert("Appointment ADMINISTERED!");';
                echo 'window.location = "vaccineBatchInfo.php";';
                echo '</script>';
            }
        }
    }
}
$conn->close();
?>