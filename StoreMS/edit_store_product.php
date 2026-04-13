<?php
require('connection.php');
require('my_function.php');
session_start();

$user_first_name = $_SESSION['user_first_name'] ?? '';
$user_last_name  = $_SESSION['user_last_name'] ?? '';

if (!empty($user_first_name) && !empty($user_last_name)) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Store Product</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Store Product</h4>
                </div>

                <div class="card-body">

<?php
$store_product_name = '';
$store_product_quantity = '';
$store_product_entry_date = '';
$store_product_id = '';

if (isset($_GET['id'])) {
    $getid = $_GET['id'];

    $sql = "SELECT * FROM store_product WHERE store_product_id = $getid";
    $query = $conn->query($sql);
    $data = mysqli_fetch_assoc($query);

    $store_product_id         = $data['store_product_id'];
    $store_product_name       = $data['store_product_name'];
    $store_product_quantity   = $data['store_product_quantity'];
    $store_product_entry_date = $data['store_product_entry_date'];
}

if (isset($_GET['store_product_name']) && !empty($_GET['store_product_id'])) {

    $new_store_product_name       = $_GET['store_product_name'];
    $new_store_product_quantity   = $_GET['store_product_quantity'];
    $new_store_product_entry_date = $_GET['store_product_entry_date'];
    $new_store_product_id         = $_GET['store_product_id'];

    $sql1 = "UPDATE store_product SET 
                store_product_name       = '$new_store_product_name',
                store_product_quantity   = '$new_store_product_quantity',
                store_product_entry_date = '$new_store_product_entry_date'
            WHERE store_product_id = $new_store_product_id";

    if ($conn->query($sql1) === TRUE) {
        echo '<div class="alert alert-success">Update Successful</div>';
    } else {
        echo '<div class="alert alert-danger">Not updated: ' . $conn->error . '</div>';
    }
}
?>

<form action="" method="GET">

    <div class="mb-3">
        <label class="form-label">Product</label>
        <select name="store_product_name" class="form-select">

        <?php
        $sql = "SELECT * FROM product";
        $query = $conn->query($sql);

        while ($data = mysqli_fetch_array($query)) {
            $data_id   = $data['product_id'];
            $data_name = $data['product_name'];
        ?>
            <option value="<?php echo $data_id; ?>"
                <?php if ($store_product_name == $data_id) echo 'selected'; ?>>
                <?php echo $data_name; ?>
            </option>
        <?php } ?>

        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" name="store_product_quantity"
               class="form-control"
               value="<?php echo $store_product_quantity; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Entry Date</label>
        <input type="date" name="store_product_entry_date"
               class="form-control"
               value="<?php echo $store_product_entry_date; ?>">
    </div>

    <input type="hidden" name="store_product_id"
           value="<?php echo $store_product_id; ?>">

    <button type="submit" class="btn btn-success w-100">
        Update Store Product
    </button>

</form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>

<?php
} else {
    header('location: login.php');
}
?>