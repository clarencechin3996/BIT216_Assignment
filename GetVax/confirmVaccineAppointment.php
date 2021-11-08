<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "getvax");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {
    if (!empty($_POST['vaccinationID'])) {
        $vaccinationID = $_POST['vaccinationID'];
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("No vaccination ID selected! Please select a vaccination ID!");';
        echo 'window.location = "vaccineBatchInfo.php";';
        echo '</script>';
    }
    $sql = "SELECT * FROM vaccination WHERE vaccinationID = '$vaccinationID'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userID = $row["userID"];
            $batchNo = $row["batchNo"];
        }
    }
}
$_SESSION["VACID"] = $vaccinationID;
$_SESSION["BATCHNO"] = $batchNo;
?>
<!DOCTYPE HTML>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>GetVax - Confirm Vaccination Appointment</title>

    <meta name="description" content="website description" />
    <meta name="keywords" content="website keywords, website keywords" />
    <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <style>
        h1 {
            font-weight: bold;
        }

        table {
            font-size: 16px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        footer {
            background-color: #008080;
            color: whitesmoke;
            font-size: 13px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
    </style>
</head>

<body>
    <div id="main">
        <div id="header">
            <div id="logo_text">
                <!-- class="logo_colour", allows you to change the colour of the text -->
                <h1><a href="adminHome.php">Get<span class="logo_colour">Vax</span></a></h1>
                <h2>Healthcare. Service. Public.</h2>
            </div>


        </div>
        <div id="site_content">
            <h1 style="text-align: center; margin: 10px 0 40px 80px;">Confirm Vaccination Appointment <button style="margin-left: 30px; float: right;" class="btn btn-outline-secondary" type="button" id="button-addon2"><a href="vaccineBatchInfo.php" style="text-decoration: none; color: inherit;">BACK </a> </button></h1>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Full Name</th>
                        <th>IC/Passport</th>
                        <th>Batch No</th>
                        <th>Expiry Date</th>
                        <th>Manufacturer</th>
                        <th>Vaccine Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        error_reporting(0); //Disable showing null error
                        $sql = "SELECT * FROM patient WHERE id = '$userID'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<td>" . $row["fullName"] . "</td><td>" . $row["ic_passport"] . "</td>";
                            }
                        }
                        ?>
                        <?php
                        $sql = "SELECT * FROM batch WHERE batchNo = '$batchNo'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $vaccineID = $row["vaccineID"];
                                echo "<td>" . $row["batchNo"] . "</td><td>" . $row["expiryDate"] . "</td>";
                            }
                        }
                        ?>
                        <?php
                        $sql = "SELECT * FROM vaccine WHERE vaccineID = '$vaccineID'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<td>" . $row["manufacturer"] . "</td><td>" . $row["vaccineName"] . "</td>";
                            }
                        }
                        $conn->close();
                        ?>
                    </tr>
                </tbody>
            </table>
            <form method="post" action="updateVaccineAppointment.php">
                <div class="input-group mb-3" style="margin-top: 35px;">
                    <button class="btn btn-outline-secondary" type="submit" name="confirm">Confirm</button>
                    <button class="btn btn-outline-secondary" type="submit" name="reject">Reject</button>
                    <input type="text" name="REJECT" class="form-control" placeholder="[REJECT]: Enter any remarks">
                </div>
            </form>
        </div>

    </div>
</body>
<footer>
    <div class="container p-1">
        <div class="row">
            <div style="margin-top: 40px;" class="col-xl-6 col-md-12 mb-4">
                <h5 style="font-size: 25px; color:white;">GetVax</h5>
                <p>
                    GetVax is an official page for requesting vaccination appointments,
                    and it allows people to select the vaccine of their choice. Many clinics and hospital
                    had join GetVax in order to get everyone who have not been vaccinated yet.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" style="margin-left:260px; margin-top: 40px;">
                <h4 class="mb-1 text-white">Opening Hours</h5>
                    <table class="table" style="border-color: white; color:whitesmoke;">
                        <tbody>
                            <tr>
                                <td>Mon - Fri:</td>
                                <td>8am - 9pm</td>
                            </tr>
                            <tr>
                                <td>Sat - Sun:</td>
                                <td>8am - 1am</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2021 Copyright:
        <a class="text-white" style="text-decoration: none;">GetVax.com</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- End of .container -->

</html>