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
  <link rel="stylesheet" href="style.css">
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
      <img src="../public/lp2.png" alt="">
    </div>
    <div class="col-lg-6 col-md-12 col-12" style="font-family: 'Dancing Script', cursive;
      font-family: 'Shantell Sans', cursive;">
      <br>
      <br>
      <br>
      <br>
      <hr>
      <h1 class="text-center"><b>Sign Up</b></h1>
      <hr>
      <div class="row">
        <!-- Make the form use col-12 on small screens -->
        <div class="col-12 d-none" id="msgdiv">
          <div class="alert alert-danger" role="alert" id="msg"></div>
        </div>
        <div class="col-12 col-md-6">

          <label class="form-label">First Name</label>
          <input class="form-control" type="text" placeholder="ex: John" id="fname" />
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Last Name</label>
          <input class="form-control" type="text" placeholder="ex: Doe" id="lname" />
        </div>

        <div class="col-12">
          <label class="form-label">Email</label>
          <input class="form-control" type="email" placeholder="ex: john@gmail.com" id="email" />
        </div>
        <div class="col-12">
          <label class="form-label">Password</label>
          <input class="form-control" type="password" placeholder="ex: ********" id="password" />
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Mobile</label>
          <input class="form-control" type="text" placeholder="ex: 077 111 5552" id="mobile" />
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Gender</label>
          <select class="form-control" id="gender">
            <option>Select Your Gender</option>
            <?php
            require "connection.php";
            $rs = database::search("SELECT * FROM `gender`");
            $n = $rs->num_rows;

            for ($x = 0; $x < $n; $x++) {

              # code...
              $d = $rs->fetch_assoc();

            ?>

              <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"] ?></option>
            <?php

            }

            ?>
          </select>
        </div>
        <div class="col-12">
          <!-- Add <br> tag here -->
          <br>
          <div class="row">
            <div class="col-12 col-md-6">
              <button class="col-12 btn btn-primary" onclick="signup();">Sign Up</button>
            </div>
            <br>
            <br>
            <div class="col-12 col-md-6">
              <form action="login.php">
                <button class="col-12 btn btn-secondary">Already have an Account Sign In</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <br>
    </div>

  </div>
  <br>
  <br>
  <div class="col-12 text-center">
    © 2023 AMELIYA || All Rights Reserved
  </div>
  <script src="script.js"></script>
</body>

</html>