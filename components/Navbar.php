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

<body class="p-3 m-0 border-0 body">
  <nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">
        <h2>Ameliya</h2>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item" style="margin-right: 10px;">
            <form action="./components/cart.php" class="d-flex mt-2">
              <button style="background: none; border:none; color:#212529;" type="submit">
                <i class="bi bi-bag"></i> <b>Cart</b>
              </button>
            </form>
          </li>
          <li class="nav-item">
            <?php if (isset($_SESSION["u"])) {
              $session_data = $_SESSION["u"];
            ?>
            <div class="d-flex align-items-center">
              <span class="navbar-text me-2">
                <b><?php echo $session_data["fname"] . " " . $session_data["lname"]; ?></b>
              </span>
              <form action="./components/userprofile.php" class="d-inline">
                <button class="btn btn-link" style="background: none; border:none;">
                  <i class="bi bi-person"></i>
                </button>
              </form>
              <button class="btn btn-link text-danger fw-bold" style="background: none; border:none;" onclick="signout();">
                Sign Out
              </button>
            </div>
            <?php } else { ?>
            <a href="./components/login.php" class="btn btn-link text-decoration-none fw-bold">
              <b style="color:#212529;">Sign In Or Create Account</b>
            </a>
            <?php } ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <script src="../app/script.js"></script>
</body>

</html>
