<?php
require('connection.php');
require('my_function.php');
session_start();

ob_start(); // ✅ FIX: added output buffering

$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];

if(!empty($user_first_name) && !empty($user_last_name)) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Spend Product</title>
    <?php include 'links.php'; ?>
</head>
<body>

<?php
if(isset($_GET['spend_product_name'])){

    $spend_product_name         = $_GET['spend_product_name'];
    $spend_product_quantity     = $_GET['spend_product_quantity'];
    $spend_product_entry_date   = $_GET['spend_product_entry_date'];

    $sql = "INSERT INTO spend_product
    (spend_product_name, spend_product_quantity, spend_product_entry_date)
    VALUES ('$spend_product_name', '$spend_product_quantity', '$spend_product_entry_date')";

    if($conn->query($sql) == TRUE){
        echo 'Data Inserted';
    }else{
        echo 'Data not inserted';
    }
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">

    Product :<br>
    <select name="spend_product_name">
        <?php
         data_list('product', 'product_id', 'product_name');
        ?>
    </select><br><br>

    Product Quantity :<br>
    <input type="text" name="spend_product_quantity"><br><br>

    Spend Entry Date :<br>
    <input type="date" name="spend_product_entry_date"><br><br>

    <input type="submit" value="submit">
</form>

<?php
$content = ob_get_clean();
include('layout.php');
?>

</body>
</html>

<?php 
} else {
    header('location: login.php');
}
?>