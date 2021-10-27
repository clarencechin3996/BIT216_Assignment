<?php
require_once 'db.php';
session_start();
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
            Welcome <?php echo $_SESSION["username"] ?><a href="login.html" style="text-decoration: none; margin-right: 30px;"> | Log Out</a>
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
      $sql = "SELECT * FROM administrator WHERE username = 'Kong';";
      $result = $conn->query($sql);
      
      while($row = mysqli_fetch_assoc($result)){
        $hc = $row['healthcarecenters'];
      }
      ?>

      <h3>Healthcare Centre: <?php echo $hc?></h3>
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

        $sql = "SELECT vaccineName, batchNo,numberOfPendingAppointment FROM vaccine, batch WHERE batch.vaccineID = vaccine.vaccineID AND batch.centreName = 'CherryHos';";
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

      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Enter BatchNo:" aria-label="Enter BatchNo:" aria-describedby="button-addon2" id="textbatch">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Find</button>
        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Delete</button>
      </div>


      <!--Healthcare Centre Batch Information Table-->
      <h2>Batch Information</h2>
      <table style="width:80%; border-spacing:0; text-align: center;" class="" id="">
        <thead>
          <tr>
            <th>Expiry Date</th>
            <th>Number of Pending Appointment</th>
            <th>Quantity Available</th>
            <th>Quantity Administered</th>
          </tr>
        </thead>
        <tbody>

        </tbody>

      </table>

      <!--Healthcare Centre Vaccine Batch Information Table-->
      </table>
      <h2>Vaccination List</h2>
      <table style="width:60%; border-spacing:0;" class="d" id="vaccinationtbl">
        <thead>
          <tr>
            <th>Vaccination ID</th>
            <th>Appointment Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Enter Vaccination ID:" aria-label="Enter Vaccination ID:" aria-describedby="button-addon2" id="textbatch">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Confirm Vaccination
          Appointment</button>
        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Record Vaccination
          Administered</button>
      </div>


    </div>
  </div>
  </div>

</body>

</html>