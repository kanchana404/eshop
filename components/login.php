<!doctype html>
<html lang="en">
<?php
                                $email = "";
                                $password = "";

                                if (isset($_COOKIE["email"])) {
                                    $email = $_COOKIE["email"];
                                }

                                if (isset($_COOKIE["password"])) {
                                    $password = $_COOKIE["password"];
                                }
                                ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Shantell+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
  <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

  <!-- Example Code -->

  <div class="row col-12">
    <!-- Hide the image on small screens (col-lg-6 will only apply on large screens) -->
    <div class="col-lg-6 d-none d-lg-block text-center">
      <br>
      <br>
      <br>
      <img src="../public/lp1.png" alt="">
    </div>
    <div class="col-lg-6 col-md-12 col-12" style="font-family: 'Dancing Script', cursive;
      font-family: 'Shantell Sans', cursive;">
      <br>
      <br>
      <br>
      <br>
      <hr>
      <h1 class="text-center"><b>Sign In</b></h1>
      <hr>
      <br>


      <label for="email" style="font-size: 20px;">Email:</label>
      <input type="text" class="email form-control" id="email2">

      <br>

      <label for="pswd" style="font-size: 20px;">Password:</label>
      <input type="password" class="pswd form-control" id="password2">
      <br>
      <div class="col-12 row">
        <div class="col-4">
        <input class="form-check-input" type="checkbox" value="" id="rememberme">
                                    <label class="form-check-label" for="rememberme">
                                       <b>Remember Me.</b> 
                                    </label>
        </div>
        <div class="col-4"></div>
        <div class="col-4">
          <a href="forgetpswd.php" class="text-primary-emphasis" > <b>Forgot Password?</b></a>
        </div>
      </div>
      <br>
      <div class="row col-12">
        <div class="col text-center">
          <button class="col-8 btn btn-primary" onclick="signin();"><b>Sign In</b></button>
        </div>

      </div>
      <hr>
      <br>

      <div class="col-12 text-start">
        <div class="col-10">
          <b>
            New to our store. Please <a href="../components/Signup.php"> Create a New Account</a>.
          </b>
        </div>
      </div>
      
    </div>

  </div>
  <br>
  <br>
  <div class="col-12 text-center">
    © 2023 AMELIYA || All Rights Reserved
  </div>
  <!-- End Example Code -->

  <script src="../app/script.js"></script>
</body>

</html>