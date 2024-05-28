<!doctype html>
<html lang="en">
<?php
session_start();
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Header</title>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols body">



  <div class="col-12 ">
    <div class="row align-items-start">
      <div class="col-3 text-center">
        <form action="/zzzz">
        <button style="background: none; border:none;">
          <img src="../public/logo.png" alt="">
        </button>
        </form>
       
      </div>
      <div class="col-5 text-start"  >
        <nav class="navbar bg-body-tertiary"  >
          <div class="col-12" >
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
          </div>
        </nav>
      </div>
      <div class="col mt-3 text-center">
        <form action="./components/cart.php">
        <button style="background: none; border:none; color:#212529;" type = "submit"><i class="bi bi-bag" ></i> <b>Shoping Cart</b></button>
      
        </form>
        </div>

      <div class="col-lg text-center mt-3 col-6 ">
        <button style="background: none; border:none; "><i class="bi bi-person"></i>
          <?php
          if (isset($_SESSION["u"])) {
            $session_data = $_SESSION["u"];
          ?>
            <form action="userprofile.php">
              <button style="background: none; border:none;">
                <span class="text-lg-start" style="color:#212529;"><b>
                    <?php echo $session_data["fname"] . " " . $session_data["lname"]; ?></b>
                </span>
              </button>
            </form>


            <br>

            <button style="background: none; border:none;">
              <span class="text-lg-start fw-bold text-danger" onclick="signout();">Sign Out</span> </button>



          <?php
          } else {
          ?>
            <a href="./components/login.php" class="text-decoration-none fw-bold">
              <b style="color:#212529;">Sign In Or Create Account</b>
            </a>
          <?php
          }
          ?>



        </button>


      </div>
    </div>
  </div>
  <hr>


  <script src="../app/sc"></script>
</body>

</html>