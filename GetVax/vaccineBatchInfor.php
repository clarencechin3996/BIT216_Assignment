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
    table {
      margin: 10px 0 30px 0;
      width: 50%;
      border-spacing: 0;
    }

    table tr th {
      background: #47433F;
      color: #FFF;
      padding: 10px 4px;
      text-align: center;
    }

    table tr td {
      background: #F4F4EE;
      color: #47433F;
      padding: 10px 4px;
      border-top: 1px solid #FFF;
      text-align: center;
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
      <h2 style="text-align: center;">Vaccine Batch Information</h2>
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
      <h3>Healthcare Centre: <?php echo $hc ?></h3>
      <table>
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
        <select class="form-control" name="batchNo">
          <option disabled selected>-- Select batch number --</option>
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
      </form>


      <!--Healthcare Centre Batch Information Table-->
      <h2>Batch Information</h2>
      <table style="width:100%; border-spacing:0; text-align: center;">
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
      <table style="width:60%; border-spacing:0;">
        <tr>
          <th>Vaccination ID</th>
          <th>Appointment Date</th>
          <th>Status</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "getvax");
        if ($conn->connect_error) {
          die("Connection Failed: " . $conn->connect_error);
        }
        $sql = "SELECT vaccinationID, appointmentDate, status_s FROM vaccination WHERE batchNo = '$selected'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["vaccinationID"] . "</td><td>" . $row["appointmentDate"] . "</td><td>" . $row["status_s"] . "</td></tr>";
          }
          echo "</table>";
        }
        $conn->close();
        ?>
      </table>
      <form method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Enter Vaccination ID:" aria-label="Enter Vaccination ID:" aria-describedby="button-addon2" id="vaccinationID" name="vaccinationID">
          <button class="btn btn-outline-secondary" type="submit" name="submit" id="button-addon2" formaction="confirmVaccineAppointment.php">Confirm Vaccination
            Appointment</button>
          <button class="btn btn-outline-secondary" type="submit" name="submit" id="button-addon2" formaction="recordVaccineAdministered.php">Record Vaccination
            Administered</button>
        </div>
      </form>

      <?php
      
      ?>
    </div>
  </div>
  </div>

</body>

</html>