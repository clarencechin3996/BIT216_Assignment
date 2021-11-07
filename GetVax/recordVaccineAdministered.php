<?php
session_start();
$name = $_SESSION["username"];
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

    <title>GetVax - Record Vaccine Administered</title>

    <meta name="description" content="website description" />
    <meta name="keywords" content="website keywords, website keywords" />
    <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
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
            <h1 style="text-align: center; margin-bottom: 40px;">Record Vaccination Administered</h1>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">IC/Passport</th>
                        <th scope="col">Batch No</th>
                        <th scope="col">Expiry Date</th>
                        <th scope="col">Manufacturer</th>
                        <th scope="col">Vaccine Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        error_reporting(0); //Disable showing null error
                        $conn = mysqli_connect("localhost", "root", "", "getvax");
                        if ($conn->connect_error) {
                            die("Connection Failed: " . $conn->connect_error);
                        }
                        if (isset($_POST['submit'])) {
                            if (!empty($_POST['vaccinationID'])) {
                                $vaccinationID = $_POST['vaccinationID'];
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
                        ?>
                    </tr>
                </tbody>
            </table>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter any remarks:" aria-label="Enter remarks:" aria-describedby="button-addon2" id="remark" style="margin-bottom: 30px;">
            </div>
            <div style="text-align: center;">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2"><a href="vaccineBatchInfor.php" style="text-decoration: none; color: inherit;">Record
                        Vaccination Administered</a> </button>
            </div>
      
        </div>
    </div>
</body>

</html>