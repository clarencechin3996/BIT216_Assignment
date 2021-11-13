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
  <!-- Development version -->
  <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>GetVax - View Vaccine Batch Information</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />

  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <style>
    .styled-table {
      border-collapse: collapse;
      font-size: 1.04em;
      font-family: sans-serif;
      min-width: 400px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table tr {
      background-color: #009879;
      color: #ffffff;
      text-align: left;
    }

    .styled-table th,
    .styled-table td {
      padding: 12px 15px;
    }

    .styled-table td {
      background: #d8f3dc;
      color: black;
      font-weight: bold;
    }

    .styled-table tr {
      border-bottom: 1px solid #dddddd;
    }

    input {
      display: block;
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
        <!-- class="logo_colour", change the colour of the text -->
        <h1><a href="adminHome.php">Get<span class="logo_colour">Vax</span></a></h1>
        <h2>Healthcare. Service. Public.</h2>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-size: 20px;">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="adminHome.php">Home</a>
            </li>
            <li class="nav-item" style="margin-left: 20px;">
              <a class="nav-link active" href="vaccineBatchInfor.php" style="font-weight: bold;">Vaccine Batch Information</a>
            </li>
          </ul>
          <span class="navbar-text" style="color: black;">
            Welcome <?php echo $name ?><a href="login.html" style="text-decoration: none; margin-right: 30px;"> | Log Out</a>
          </span>
        </div>
      </div>
    </nav>
    <div id="site_content">
      <h2 style="text-align: center; font-size:26px;">Vaccine Batch Information</h2>
      <?php
      $conn = mysqli_connect("localhost", "root", "", "getvax");
      if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
      }
      $sql = "SELECT * FROM administrator WHERE username = '$name';";
      $result = $conn->query($sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $hc = $row['healthcarecenters'];
      }
      ?>
      <h2>Healthcare Centre:<?php echo $hc ?></h3>
        <table class="styled-table" style="margin-bottom: 30px;">
          <tr>
            <th>Vaccine Name</th>
            <th>Batch No</th>
            <th>Number of Pending appointment</th>
          </tr>

          <?php
          $conn = mysqli_connect("localhost", "root", "", "getvax");
          if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
          }

          $sql = "SELECT vaccineName, batchNo,numberOfPendingAppointment FROM vaccine, batch WHERE batch.vaccineID = vaccine.vaccineID AND centreName ='$hc'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["vaccineName"] . "</td><td>" . $row["batchNo"] . "</td><td>" . $row["numberOfPendingAppointment"] . "</td></tr>";
            }
            echo "</table>";
          } else {
            echo "0 result";
          }
          $conn->close();
          ?>
        </table>

        <form method="post">
          <div class="input-group sm-1" style="width: 60%;">
            <select class="form-control" name="batchNo">
              <option disabled selected>-- Select batch number -- </option>
              <?php
              $conn = mysqli_connect("localhost", "root", "", "getvax");
              if ($conn->connect_error) {
                die("Connection Failed: " . $conn->connect_error);
              }
              $sql = "SELECT * From batch WHERE centreName = '$hc'";
              $result = $conn->query($sql);

              while ($data = mysqli_fetch_array($result)) {
                echo "<option value='" . $data['batchNo'] . "'>" . $data['batchNo'] . "</option>";  // displaying data in option menu
              }
              ?>
            </select>
            <button class="btn btn-outline-secondary" type="submit" name="submit" id="button-addon2"> Find </button>
          </div>
        </form>


        <!--Healthcare Centre Batch Information Table-->
        <h2 style="margin-top: 20px;">Batch Information</h2>
        <table class="styled-table" style="width:80%; border-spacing:0; margin-bottom: 30px;">
          <tr>
            <th>Expiry Date</th>
            <th>Number of Pending Appointment</th>
            <th>Quantity Available</th>
            <th>Quantity Administered</th>
          </tr>
          <?php
          $conn = mysqli_connect("localhost", "root", "", "getvax");
          if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
          }
          if (isset($_POST['submit'])) {
            if (!empty($_POST['batchNo'])) {
              $selected = $_POST['batchNo'];
            }
          }
          error_reporting(0); //Disable showing null error
          $sql = "SELECT expiryDate, numberOfPendingAppointment, quantityAvailable, quantityAdministered FROM batch WHERE batchNo = '$selected'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["expiryDate"] . "</td><td>" . $row["numberOfPendingAppointment"] . "</td><td>" . $row["quantityAvailable"] . "</td><td>" . $row["quantityAdministered"] . "</td></tr>";
            }
            echo "</table>";
          }
          $conn->close();
          ?>
        </table>

        <!--Healthcare Centre Vaccine Batch Information Table-->
        </table>
        <h2>Vaccination List</h2>
        <table class="styled-table" style="width:80%; border-spacing:0; margin-bottom:20px;">
          <tr>
            <th>Vaccination ID</th>
            <th>Appointment Date</th>
            <th>Status</th>
            <th>Remark</th>
          </tr>
          <?php
          $conn = mysqli_connect("localhost", "root", "", "getvax");
          if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
          }
          $sql = "SELECT * FROM vaccination WHERE batchNo = '$selected'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["vaccinationID"] . "</td><td>" . $row["appointmentDate"] . "</td><td>" . $row["status_s"] . "</td><td>" . $row["remark"] . "</td></tr>";
            }
            echo "</table>";
          }
          $conn->close();
          ?>
        </table>
        <form method="post">
          <div class="input-group sm-1" style="width: 100%;">
            <select class="form-control" name="vaccinationID">
              <option disabled selected>-- Select vaccinationID: --</option>
              <?php
              $conn = mysqli_connect("localhost", "root", "", "getvax");
              if ($conn->connect_error) {
                die("Connection Failed: " . $conn->connect_error);
              }
              $sql = "SELECT * From vaccination WHERE batchNo = '$selected'";
              $result = $conn->query($sql);
              while ($data = mysqli_fetch_array($result)) {
                echo "<option value='" . $data['vaccinationID'] . "'>" . $data['vaccinationID'] . "</option>";  // displaying data in option menu
              }
              $conn->close();
              ?>
            </select>
            <button class="btn btn-outline-secondary" type="submit" name="submit" id="button-addon2" formaction="confirmVaccineAppointment.php">Confirm Vaccination
              Appointment</button>
            <button class="btn btn-outline-secondary" type="submit" name="submit" id="button-addon2" formaction="recordVaccineAdministered.php">Record Vaccination
              Administered</button>
          </div>
        </form>
    </div>
  </div>
  </div>

</body>
<footer>
  <div class="container p-1">
    <div class="row">
      <div style="margin-top: 20px;" class="col-xl-6 col-md-12 mb-4">
        <h2 style="font-size: 30px; color:white;">GetVax</h2>
        <p>
          GetVax is an official page for requesting vaccination appointments,
          and it allows to select the vaccine of their choice. Many clinics and hospital
          had join GetVax in order to get everyone who have not been vaccinated yet.
        </p>
      </div>
      <div class="col-lg-3 col-md-6 mb-4" style="margin-left:260px; margin-top: 25px;">
        <h3 class="mb-1 text-white">Opening Hours</h3>
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