<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Quantities</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<section id="qty">
    <?php 
    require "../../components/connection.php";
    // Assuming Database::search is a method that executes a SQL query and returns the result
    $padnqty = Database::search("SELECT id, qty, title FROM product");
    $padnqty_num = $padnqty->num_rows;
    ?>
    <div class="container mt-4">
        <h1>Product Quantities</h1>
        <div class="table-container">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Quantity</th>
                        <th>Update Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    for ($i = 0; $i < $padnqty_num; $i++) {
                        $padnqty_data = $padnqty->fetch_assoc();
                    ?>
                    <tr>
                        <td><?php echo $padnqty_data["title"]; ?></td>
                        <td><?php echo $padnqty_data["qty"]; ?></td>
                        <td>
                            <form action="update_quantity.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $padnqty_data['id']; ?>">
                                <input type="number" name="new_qty" value="<?php echo $padnqty_data['qty']; ?>" min="0" class="form-control" style="width: 100px; display: inline-block;">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
