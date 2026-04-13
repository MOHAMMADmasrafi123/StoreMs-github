<?php
require('connection.php');
session_start();

$user_first_name = $_SESSION['user_first_name'] ?? '';
$user_last_name  = $_SESSION['user_last_name'] ?? '';

if (!empty($user_first_name) && !empty($user_last_name)) {


$sql1 = "SELECT * FROM product";
$query1 = $conn->query($sql1);

$data_list = array();

while ($data1 = mysqli_fetch_assoc($query1)) {
    $product_id   = $data1['product_id'];
    $product_name = $data1['product_name'];

    $data_list[$product_id] = $product_name;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>List of Store Product</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h3 class="mb-3">
        Welcome, <?php echo $user_first_name . " " . $user_last_name; ?>
    </h3>

    <h4 class="mb-4">Store Product List</h4>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Entry Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $sql = "SELECT * FROM store_product";
        $query = $conn->query($sql);

        while ($data = mysqli_fetch_assoc($query)) {

            $store_product_id         = $data['store_product_id'];
            $store_product_name       = $data['store_product_name'];
            $store_product_quantity   = $data['store_product_quantity'];
            $store_product_entry_date = $data['store_product_entry_date'];

            echo "<tr>
                <td>" . ($data_list[$store_product_name] ?? 'Unknown') . "</td>
                <td>$store_product_quantity</td>
                <td>$store_product_entry_date</td>
                <td>
                 <a href='edit_store_product.php?id=$store_product_id' class='btn btn-sm btn-primary'>
                <i class='fa fa-edit'></i> Edit
                </a>
                </td>
                </tr>";
        }
        ?>
        </tbody>
    </table>

</div>

</body>
</html>

<?php
} else {
    header('location: login.php');
}
?>