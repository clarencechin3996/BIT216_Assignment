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

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>GetVax - Record New Vaccination Batch</title>
  <title>GetVax - Request Vaccination Appointment</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <script type="text/javascript" src="style/class.js">
  </script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    var a;

    function show() {
      if (a == 1) {
        document.getElementById("vaccineTable").style.display = "none";
        return a = 0;
      } else {
        document.getElementById("vaccineTable").style.display = "block";
        return a = 1;
      }
    }

    /*    $(document).ready(function(){
          $("#vaccineList").on('change',function(){
            $(".data").hide();
            $("#" + $(this).val()).fadeIn(700);
        }).change();
      });

      $(document).ready(function(){
        $("#healthcareCenters").on('change',function(){
          $(".bdata").hide();
          $("#" + $(this).val()).fadeIn(700);
      }).change();
    });

    $(document).ready(function(){
      $("#availableBatches").on('change',function(){
        $(".vdata").hide();
        $("#" + $(this).val()).fadeIn(700);
    }).change();
    });*/

    function submit() {
      alert("Appointment Created!");
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

    .btn {
      margin-top: 20px;
      margin-bottom: 20px;
      margin-left: 50px;
      width: 261px;

    }

    .table {
      width: 700px;
      margin-top: 20px;
    }

    .form-select {
      width: 492px;
      margin-top: 20px;
      margin-bottom: 20px;
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
        <h1><a href="patientHome.php">Get<span class="logo_colour">Vax</span></a></h1>
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
              <a class="nav-link " aria-current="page" href="patientHome.php" style="font-weight: bold;">Home</a>
            </li>
            <li class="nav-item" style="margin-left: 20px;">
              <a class="nav-link active" href="requestVaccinationAppointment.php">Vaccination Appointment</a>
            </li>
          </ul>
          <span class="navbar-text">
            Welcome <?php echo $name ?><a href="logout.php" style="text-decoration: none; margin-right: 30px;"> | Log Out</a>
          </span>
        </div>
      </div>
    </nav>
    <div id="site_content">
      <!-- insert the page content here -->
      <h1>Request Vaccination Appointment</h1>

      <div class="form-row">
        <div class="col-lg-7">
          <label for="chooseVaccine">View Available Vaccines:</label>
          <button type="button" id="showhide" class="btn btn-secondary" onclick="show()">Show/Hide Table</button>
        </div>
      </div>

      <div id="vaccineTable" style="display: none;">
        <table class="table table-striped table table-bordered">
          <tr>
            <th>Manufacturer</th>
            <th>Vaccine Name</th>
          </tr>
          <?php
          require 'db.php';
          $sql = mysqli_query($conn, "SELECT * FROM vaccine");
          while ($row = mysqli_fetch_assoc($sql)) {
            echo "<tr>";
            echo "<td>" . $row['manufacturer'] . "</td>";
            echo "<td>" . $row['vaccineName'] . "</td>";
            echo "</tr>";
          }
          ?>
      </div>



      <div id="healthcareCentersTable" style="display: none;">
        <table class="table table-striped table table-bordered">

        </table>
      </div>
      <form action="saveAppointmentRequest.php" method="POST">

        <div class="wrapper">
          <div class="menu">
            <label for="chooseVaccine">Select Required Vaccine:</label>
            <select id="vaccineList" name="vaccineList" class="form-select" aria-label="Default select example">
              <option value="None" selected>-</option>
              <?php
              require 'db.php';
              $sql = mysqli_query($conn, "SELECT * FROM vaccine");
              while ($row = mysqli_fetch_assoc($sql)) {
                echo "<option value=" . $row['vaccineID'] . ">" . $row['vaccineName'] . "</option>";
              }
              ?>
            </select>
          </div>

          <div class="vaccineAvailableCenters" id="res">



          </div>
        </div>

        <div class="wrapper">
          <div class="menu">
            <label for="healthcareCenters">View a Healthcare Center:</label>
            <select id="healthcareCenters" name="healthcareCenters" class="form-select" aria-label="Default select example">
              <option value="none">-</option>
            </select>
          </div>

          <div class="availableBatches" id="a_batches">

          </div>
        </div>

        <div class="wrapper">
          <div class="menu">
            <label for="availableBatches">Select Batch Number:</label>
            <select id="availableBatches" name="availableBatches" class="form-select" aria-label="Default select example">
              <option value="none">-</option>

            </select>
          </div>

          <div class="quantityAvailable" id="batch_n">


          </div>

        </div>

        <div class="form-row">
          <div class="col-lg-7">
            <label for="test">Select Appointment Date:</label>
            <input type="date" required name="appointmentDate" placeholder="Expiry Date" class="form-control my-2 p-3">
          </div>
        </div>
        <div class="form-row">
          <div class="col-lg-7">

            <button type="submit" class="btn2 mt-3 mb-5">Make New Appointment</button>
          </div>
        </div>

      </form>


    </div>
  </div>
</body>

</html>
<script>
  $(document).ready(function() {
    function load_data(query) {
      $.ajax({
        url: "fetch.php",
        method: "POST",
        data: {
          query: query
        },
        success: function(data) {
          $('#res').html(data);
          $('#batch_n').html('');
          $('#a_batches').html('');
          $('#availableBatches').html('<option value="none">-</option>');
        }
      });
    }

    function load_data2(query) {
      $.ajax({
        url: "fetch_hc.php",
        method: "POST",
        data: {
          query: query
        },
        success: function(data) {
          $('#healthcareCenters').html(data);
        }
      });
    }

    function load_batch(query, query2) {
      $.ajax({
        url: "fetch_batch.php",
        method: "POST",
        data: {
          query: query,
          query2: query2
        },
        success: function(data) {
          $('#a_batches').html(data);

        }
      });
    }

    function load_batch2(query, query2) {
      $.ajax({
        url: "fetch_batch2.php",
        method: "POST",
        data: {
          query: query,
          query2: query2
        },
        success: function(data) {
          $('#availableBatches').html(data);
        }
      });
    }

    function load_batch3(query) {
      $.ajax({
        url: "fetch_batch3.php",
        method: "POST",
        data: {
          query: query
        },
        success: function(data) {
          $('#batch_n').html(data);
        }
      });
    }

    $('#vaccineList').change(function() {
      if ($(this).val() != 'none') {
        var search = $(this).val();
        load_data(search);
        load_data2(search);
      }

    });

    $('#healthcareCenters').change(function() {
      if ($(this).val() != 'none') {
        var search = $(this).val();
        var search2 = $('#vaccineList').val();

        load_batch(search, search2);
        load_batch2(search, search2);
      }
    });

    $('#availableBatches').change(function() {
      if ($(this).val() != 'none') {
        var search = $(this).val();
        load_batch3(search);
      }
    });

  });
</script>