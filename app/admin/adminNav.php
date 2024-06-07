<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .dropdown-item:hover, .dropdown-item:focus {
      background-color: transparent !important;
      color: inherit !important;
    }
  </style>
  <title>Bootstrap Example</title>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-auto">
        <div class="dropdown">
          <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
           Product Management
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./addproduct.php">Add Product</a></li>
            <li><a class="dropdown-item" href="./deleteproduct.php">Delete Product</a></li>
            
          </ul>
        </div>
      </div>
      <div class="col-auto">
        <div class="dropdown">
          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Delevery Management
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../admin/editpbc.php">Add province, District, city</a></li>
            <li><a class="dropdown-item" href="../admin/deletepcb.php">Delete province, District, city</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
