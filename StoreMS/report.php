<?php
require('connection.php');
session_start();

$user_first_name = $_SESSION['user_first_name'] ?? '';
$user_last_name  = $_SESSION['user_last_name'] ?? '';

if(!empty($user_first_name) && !empty($user_last_name)){

$sql3 = "SELECT * FROM product";
$query3 = $conn->query($sql3);

$data_list = array();

while($data3 = mysqli_fetch_assoc($query3)){
    $product_id   = $data3['product_id'];
    $product_name = $data3['product_name'];

    $data_list[$product_id] = $product_name;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h3>Welcome, <?php echo $user_first_name . " " . $user_last_name; ?></h3>

    <!-- 🔹 Form -->
    <div class="card p-3 mt-3">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <label>Select Product Name :</label>

            <select name="product_name" class="form-control my-2">
                <?php
                $sql = "SELECT * FROM product";
                $query = $conn->query($sql);

                while($data = mysqli_fetch_assoc($query)){
                    $product_id   = $data['product_id'];
                    $product_name = $data['product_name'];
                ?>
                <option value="<?php echo $product_id ?>"><?php echo $product_name ?></option>
                <?php } ?>
            </select>

            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i> Generate Report
            </button>
        </form>
    </div>

    <!-- 🔹 Store Product Report -->
    <h4 class="mt-4 text-success">Store Product</h4>

    <?php 
    if(isset($_GET['product_name'])){
        $product_id = $_GET['product_name'];

        $sql1 = "SELECT * FROM store_product WHERE store_product_name = $product_id";
        $query1 = $conn->query($sql1);

        echo "<table class='table table-bordered table-striped'>
        <thead class='table-dark'>
            <tr>
                <th>Store Date</th>
                <th>Amount</th>
            </tr>
        </thead><tbody>";

        while($data1 = mysqli_fetch_assoc($query1)){

            $store_product_quantity   = $data1['store_product_quantity'];
            $store_product_entry_date = $data1['store_product_entry_date'];
            $store_product_name       = $data1['store_product_name'];

            echo "<tr>
                <td>$store_product_entry_date</td>
                <td>$store_product_quantity</td>
            </tr>";
        }

        echo "</tbody></table>";
    }
    ?>

    
    <h4 class="mt-4 text-danger">Spend Product</h4>

    <?php 
    if(isset($_GET['product_name'])){
        $product_id = $_GET['product_name'];

        $sql4 = "SELECT * FROM spend_product WHERE spend_product_name = $product_id";
        $query4 = $conn->query($sql4);

        echo "<table class='table table-bordered table-striped'>
        <thead class='table-dark'>
            <tr>
                <th>Spend Date</th>
                <th>Amount</th>
            </tr>
        </thead><tbody>";

        while($data4 = mysqli_fetch_assoc($query4)){

            $spend_product_quantity   = $data4['spend_product_quantity'];
            $spend_product_entry_date = $data4['spend_product_entry_date'];

            echo "<tr>
                <td>$spend_product_entry_date</td>
                <td>$spend_product_quantity</td>
            </tr>";
        }

        echo "</tbody></table>";
    }
    ?>

</div>

</body>
</html>

<?php
}else{
    header('location:login.php');
}
?>