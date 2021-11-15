<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>GetVax</title>
    <style>
      *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }
      body {
        background: rgb(220, 220, 220);
        margin-top:85;
      }
      .row{
        background: white;
        height:850px;
        width:1200px;
        border-radius: 30px;

      }
      img {
        height:825px;
        width:500px;
        margin-top: 10px;
        border-radius: 30px;
      }
      .btn1 {
        border: none;
        outline-color: none;
        height:50px;
        width:100%;
        background-color: black;
        color: white;
        border-radius: 4px;
        font-weight:bold;
      }
      .btn1:hover{
        background: white;
        border: 1px solid;
        color:black;
      }

    </style>

    <script>
    function haform(){
      var x = document.getElementById("haform");
      var y = document.getElementById("paform");

            x.style.display = "block";
            y.style.display = "none";



    }
    function paform(){
      var x = document.getElementById("haform");
      var y = document.getElementById("paform");


            y.style.display = "block";
            x.style.display = "none";



    }


    </script>


  </head>
  <body>
    <section class="Form my-4 mx-5">
      <div class="container" id="HASignUp">
        <div class="row no-gutters">
            <div class="col-lg-5">
              <img src="vax4.jpg" alt="">
            </div>
            <div class="col-lg-7 px-5 pt-5">
              <h1 class="font-weight-bold py-3">GetVax</h1>
              <h4 class="font-weight-bold py-3">Create a new account</h4>
              <h6>Are you a Healthcare Administrator or a Patient?</h6>
              <input type="radio" id="hAdmin" name="userType"  onclick="haform()">
              <label for="hAdmin">Healthcare Administrator</label>
              <input type="radio" id="patient" name="userType" onclick="paform()">
              <label for="patient">Patient</label>
               <div class="container">
                  <div class="modal fade" id="createCenterModal" tabindex="-1" aria-labelledby="createCenterModal" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <form action="save_healthcare_data_s.php" method="POST">
                            <div class="modal-header">
                              <h5 class="modal-title" id="createCenterModalLabel">Create Healthcare Center</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="form-row">
                                <div class="col-lg-13">
                                  <input type="text" placeholder="Centre Name" name ="centre_name" id="CentreName" class="form-control my-2 p-3" >
                                  
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="col-lg-13">
                                  <input type="text" placeholder="Centre Address" name ="address" id="CentreAddress" class="form-control my-2 p-3" >
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-secondary">Create!</button>
                            </div>
                          </form>
                          

                        </div>
                      </div>
                  </div>
              </div>
              <form id="HAForm" action="hasignup.php" method="POST">
                <div id ="haform" style="display: none;">
                <div class="form-row">
                  <div class="col-lg-7">
                    <label for="healthcareCenters">Choose a Healthcare Center:</label>

                    <select id="healthcareCenters" name ="healthcarecenters">

                      <?php
                        require 'db.php';
                        $sql=mysqli_query($conn,"SELECT * FROM healthcare_centre");
                        while($row = mysqli_fetch_assoc($sql)){
                          echo "<option value=".$row['centreName'].">".$row['centreName']."</option>";
                        }
                        $rows = mysqli_fetch_assoc($sql);
                      ?>
                      
                    </select>
                  </div>
                </div>
                <br>
                <div class="form-row">
                  <div class="col-lg-7">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCenterModal">
                      Create Healthcare Center
                    </button>
                  </div>
                </div>
                

                <div class="form-row">
                  <div class="col-lg-7">
                    <input type="text" placeholder="Username" name ="username" id="username" class="form-control my-2 p-3" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-7">
                    <input type="password" placeholder="Password" name ="pass" id="password" class="form-control my-2 p-3" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-7">
                    <input type="text" placeholder="Full Name" name = "name" id="name" class="form-control my-2 p-3" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-7">
                    <input type="email" placeholder="Email" name="email" id="email" class="form-control my-2 p-3" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-7">
                    <input type="text" placeholder="Staff ID" name="staffid" id="staffid" class="form-control my-2 p-3" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-7">
                    <button type="submit" class="btn1 mt-3 mb-5">Sign Up</button>
                  </div>
                </div>
                <p>Already have an account? <a href="login.html">Login Here</a></p>
              </div>
              </form>

              <script src="bootstrap-validate.js"></script>
              <script>
                bootstrapValidate('#staffid', 'min:5:Enter at least 5 characters!')
              </script>


              <form id="PAForm" action="pasignup.php" method="POST">
                  <div id ="paform" style="display: none;">
                <div class="form-row">
                  <div class="col-lg-7">
                    <input type="text" placeholder="Username" name="username" id="username" class="form-control my-2 p-3" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-7">
                    <input type="password" placeholder="Password" name="pass" id="password" class="form-control my-2 p-3" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-7">
                    <input type="text" placeholder="IC or Passport" name ="ic" id="ic" class="form-control my-2 p-3" required>
                  </div>
                <div class="form-row">
                  <div class="col-lg-7">
                    <button type="submit" class="btn1 mt-3 mb-5">Sign Up</button>
                  </div>
                </div>
                <p>Already have an account? <a href="login.html">Login Here</a></p>
                </div>
                </form>
              </form>
            </div>

      </div>
      </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
