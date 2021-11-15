<?php
session_start();
$name = $_SESSION["username"];
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

  <title>GetVax - Record New Vaccination Batch</title>

  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <script type="text/javascript" src="style/class.js">
  </script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#VaccineList").on('change', function() {
        $(".data").hide();
        $("#" + $(this).val()).fadeIn(700);
      }).change();
    });
  </script>
  <script type="text/javascript">
    function validate(e) {

      var vac = document.getElementById('VaccineList').value;

      if (vac == 'none') {
        alert("Select Vaccine!");
        return false;

      }
    }
  </script>
  <style>
    .btn2 {
      border: none;
      outline-color: none;
      height: 50px;
      width: 100%;
      background-color: black;
      color: white;
      border-radius: 4px;
      font-weight: bold;
    }

    .btn2:hover {
      background: white;
      border: 1px solid;
      color: black;
    }

    .form-select {
      width: 495px;
      margin-bottom: 15px;
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
                <a class="nav-link active" href="recordVaccinationBatch.php">Record Vaccination Batch</a>
              </li>
              <li class="nav-item" style="margin-left: 20px;">
                <a class="nav-link " href="vaccineBatchInfo.php">Vaccine Batch Information</a>
              </li>
              <li class="nav-item" style="margin-left: 20px;">
                <a class="nav-link " href="recordVaccineData.php">New Vaccine Information</a>
              </li>
            </ul>
            <span class="navbar-text">
              Welcome <?php echo $name ?><a href="login.html" style="text-decoration: none; margin-right: 30px;"> | Log Out</a>
            </span>
          </div>
        </div>
      </nav>
      <div id="site_content">
        <div id="content">
          <!-- insert the page content here -->
          <form action="saveVaccinationBatch.php" method="POST" onsubmit="return validate();">
            <h1>Record Vaccination Batch</h1>
            <h2>Healthcare Centre:<?php echo $hc ?></h3>
              <div class="form-row">

                <div class="wrapper">
                  <div class="menu">
                    <label for="VaccineList">Select the Vaccine ID:</label>
                    <select id="VaccineList" name="VaccineList" class="form-select" aria-label="Default select example">
                      <option value="none">-</option>
                      <?php
                      require 'db.php';
                      $sql = mysqli_query($conn, "SELECT * FROM vaccine");
                      while ($row = mysqli_fetch_assoc($sql)) {
                        echo "<option value=" . $row['vaccineID'] . ">" . $row['vaccineID'] . "</option>";
                      }
                      $rows = mysqli_fetch_assoc($sql);
                      ?>

                    </select>
                  </div>

                  <div class="CenterAddress">
                    <div id="none" class="data">
                      <p>Manufacturer: -
                        <br> Vaccine Name: -
                      </p>
                    </div>

                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM vaccine");
                    while ($row = mysqli_fetch_assoc($sql)) {
                      $div = '';
                      $div .= '<div id="' . $row['vaccineID'] . '" class="data">';
                      $div .= '<p> Manufacturer: ' . $row['manufacturer'];
                      $div .= '<br> Vaccine Name: ' . $row['vaccineName'];
                      $div .= '</p></div>';
                      echo $div;
                    }
                    ?>
                  </div>
                </div>


                <div class="col-lg-7">
                  <label for="test">Batch Number:</label>
                  <input type="text" placeholder="Batch Number" name="batchNumber" required class="form-control my-2 p-3">
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-7">
                  <label for="test">Expiry Date:</label>
                  <input type="date" placeholder="Expiry Date" name="exp_date" value="<?php echo date('Y-m-d'); ?>" required class="form-control my-2 p-3">
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-7">
                  <label for="test">Quantity of Doses Available:</label>
                  <input type="number" placeholder="Quantity of Doses Available" name="doses" required class="form-control my-2 p-3">
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-7">
                  <button type="submit" class="btn2 mt-3 mb-5">Record New Batch</button>
                </div>
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