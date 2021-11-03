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
                <h1><a href="home.html">Get<span class="logo_colour">Vax</span></a></h1>
                <h2>Healthcare. Service. Public.</h2>
            </div>


        </div>
        <div id="site_content">
            <h1 style="text-align: center; margin-bottom: 40px;">Record Vaccination Administered</h1>
            <table style="width:100%; border-spacing:0;">
                <tr>
                    <th>Full Name</th>
                    <th>IC/Passport</th>
                    <th>Batch No</th>
                    <th>Expiry Date</th>
                    <th>Manufacturer</th>
                    <th>Vaccine Name</th>
                    <th>Vaccination Date</th>
                </tr>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "getvax");
                if ($conn->connect_error) {
                    die("Connection Failed: " . $conn->connect_error);
                }
                if (isset($_POST['submit'])) {
                    if (!empty($_POST['vaccinationID'])) {
                        $selected = $_POST['vaccinationID'];
                    }
                }
                error_reporting(0); //Disable showing null error
                $sql = "SELECT username, ic, batchNo, expiryDate, manufacturer, vaccineName FROM patient, batch, vaccine";
                $result = $conn->query($sql);
                ?>
            </table>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter any remarks:" aria-label="Enter remarks:" aria-describedby="button-addon2" id="remark" style="margin-bottom: 30px;">
            </div>
            <div style="text-align: center;">
                <button onclick="myFunction()" class="btn btn-outline-secondary" type="button" id="button-addon2"><a href="vaccineBatchInfor.html" style="text-decoration: none; color: inherit;">Record
                        Vaccination Administered</a> </button>
            </div>
            <script>
                function myFunction() {
                    alert("Administered Complete!");
                }
            </script>
        </div>
    </div>
</body>

</html>