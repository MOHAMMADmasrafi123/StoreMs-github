<?php
require('connection.php');
session_start();

$user_first_name = $_SESSION['user_first_name'] ?? '';
$user_last_name  = $_SESSION['user_last_name'] ?? '';

if(!empty($user_first_name) && !empty($user_last_name)){

// 🔹 Insert Data
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $product_id = $_POST['product_id'];
    $quantity   = $_POST['quantity'];
    $date       = $_POST['date'];

    if(!empty($product_id) && !empty($quantity) && !empty($date)){

        $sql = "INSERT INTO spend_product 
        (spend_product_name, spend_product_quantity, spend_product_entry_date)
        VALUES ('$product_id', '$quantity', '$date')";

        if($conn->query($sql)){
            $msg = "<div class='alert alert-success'> Data Inserted Successfully</div>";
        } else {
            $msg = "<div class='alert alert-danger'> Failed to Insert Data</div>";
        }

    } else {
        $msg = "<div class='alert alert-warning'>Fill all feild</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Spend Product</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h3>Welcome, <?php echo $user_first_name . " " . $user_last_name; ?></h3>

    <div class="card p-4 mt-3">

        <h4 class="mb-3">➖ Spend Product</h4>

        <?php if(isset($msg)) echo $msg; ?>

        <form method="POST">

            <!-- Product -->
            <label>Select Product</label>
            <select name="product_id" class="form-control mb-3" required>
                <option value="">-- Select Product --</option>
                <?php
                $sql = "SELECT * FROM product";
                $query = $conn->query($sql);

                while($row = mysqli_fetch_assoc($query)){
                    echo "<option value='".$row['product_id']."'>".$row['product_name']."</option>";
                }
                ?>
            </select>

            <!-- Quantity -->
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control mb-3" required>

            <!-- Date -->
            <label>Date</label>
            <input type="date" name="date" class="form-control mb-3" required>

            <!-- Button -->
            <button type="submit" class="btn btn-danger">
                <i class="fa fa-minus-circle"></i> Spend Product
            </button>

        </form>

    </div>

</div>

</body>
</html>

<?php
} else {
    header('location: login.php');
}
?>