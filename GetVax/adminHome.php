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
              <a class="nav-link" href="vaccineBatchInfor.php">Vaccine Batch Information</a>
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
          </div>
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
          </div>
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
          </div>
        </div>

      </div>
    </div>


  </div>

</body>

</html>