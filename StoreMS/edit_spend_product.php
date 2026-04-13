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
    <title>Edit Spend Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Spend Product</h4>
                </div>

                <div class="card-body">

<?php
$spend_product_name = '';
$spend_product_quantity = '';
$spend_product_entry_date = '';
$spend_product_id = '';

if (isset($_GET['id'])) {
    $getid = $_GET['id'];

    $sql = "SELECT * FROM spend_product WHERE spend_product_id = $getid";
    $query = $conn->query($sql);
    $data = mysqli_fetch_assoc($query);

    $spend_product_id          = $data['spend_product_id'];
    $spend_product_name        = $data['spend_product_name'];
    $spend_product_quantity    = $data['spend_product_quantity'];
    $spend_product_entry_date  = $data['spend_product_entry_date'];
}

if (isset($_GET['spend_product_name']) && !empty($_GET['spend_product_id'])) {

    $new_spend_product_name       = $_GET['spend_product_name'];
    $new_spend_product_quantity   = $_GET['spend_product_quantity'];
    $new_spend_product_entry_date = $_GET['spend_product_entry_date'];
    $new_spend_product_id         = (int)$_GET['spend_product_id'];

    $sql1 = "UPDATE spend_product SET 
                spend_product_name       = '$new_spend_product_name',
                spend_product_quantity   = '$new_spend_product_quantity',
                spend_product_entry_date = '$new_spend_product_entry_date'
             WHERE spend_product_id = $new_spend_product_id";

    if ($conn->query($sql1) === TRUE) {
        echo '<div class="alert alert-success">Update Successful</div>';
    } else {
        echo '<div class="alert alert-danger">Not updated: '.$conn->error.'</div>';
    }
}
?>

<form action="" method="GET">

    <div class="mb-3">
        <label class="form-label">Product</label>
        <select name="spend_product_name" class="form-select">

        <?php
        $sql = "SELECT * FROM product";
        $query = $conn->query($sql);

        while ($data = mysqli_fetch_array($query)) {
            $data_id = $data['product_id'];
            $data_name = $data['product_name'];
        ?>
            <option value="<?php echo $data_id; ?>"
                <?php if ($spend_product_name == $data_id) echo 'selected'; ?>>
                <?php echo $data_name; ?>
            </option>
        <?php } ?>

        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" name="spend_product_quantity"
               class="form-control"
               value="<?php echo $spend_product_quantity; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Entry Date</label>
        <input type="date" name="spend_product_entry_date"
               class="form-control"
               value="<?php echo $spend_product_entry_date; ?>">
    </div>

    <input type="hidden" name="spend_product_id"
           value="<?php echo $spend_product_id; ?>">

    <button type="submit" class="btn btn-primary w-100">
        Update
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