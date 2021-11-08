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

  <title>GetVax - Home</title>

  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <style>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-size: 20px;">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="adminHome.php" style="font-weight: bold;">Home</a>
            </li>
            <li class="nav-item" style="margin-left: 20px;">
              <a class="nav-link" href="vaccineBatchInfo.php">Vaccine Batch Information</a>
            </li>
          </ul>
          <span class="navbar-text" style="color: black;">
            Welcome <?php echo $name ?><a href="login.html" style="text-decoration: none; margin-right: 30px;"> | Log Out</a>
          </span>
        </div>
      </div>
    </nav>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        <h2 style="font-size: 30px;">Welcome to GetVax!</h2>
        <h2>Whats new?</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <div class="card h-100">
              <img src="style/phizer.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Phizer Available</h5>
                <p class="card-text">The Pfizer COVID-19 vaccine is now available for anyone aged 12 years and over.
                  Phizer is now available to register in GetVax with limited registration.</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 3 days ago</small>
              </div>
            </div>
          </div><!-- End of card 1 -->
          <div class="col">
            <div class="card h-100">
              <img src="style/AZ.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Astra Zeneca is at hand</h5>
                <p class="card-text">The AstraZeneca COVID-19 vaccine is available for anyone aged 18 years and over.
                </p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 1 week ago</small>
              </div>
            </div>
          </div><!-- End of card 2 -->
          <div class="col">
            <div class="card h-100">
              <img src="style/aware.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Why should we vaccinate?</h5>
                <p class="card-text">Vaccines and childhood immunization are vital practices to protecting yourself,
                  your children, and the entire population from contracting dangerous diseases and from preventing
                  outbreaks and pandemics.</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 2 weeks ago</small>
              </div>
            </div>
          </div><!-- End of card 3 -->

        </div>
      </div>
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