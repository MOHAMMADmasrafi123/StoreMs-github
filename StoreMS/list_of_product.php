<?php
require('connection.php');

session_start();

$user_first_name = isset($_SESSION['user_first_name']) ? $_SESSION['user_first_name'] : '';
$user_last_name  = isset($_SESSION['user_last_name']) ? $_SESSION['user_last_name'] : '';

if(!empty($user_first_name) && !empty($user_last_name)){

$sql1= "SELECT * FROM category";
$query1 = $conn->query($sql1);
$data_list = array(); 

while ($data1 = mysqli_fetch_assoc($query1)){
  $category_id   = $data1['category_id'];
  $category_name = $data1['category_name'];
  
  $data_list[$category_id]= $category_name;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>List of Product</title>
</head>
<body>

<?php
$sql = "SELECT * FROM product";                              
$query = $conn->query($sql);

echo "<table border='1'><tr><th>Product_name</th><th>Category</th><th>Code</th><th>Action</th></tr>";

while($data = mysqli_fetch_assoc($query)){
    $product_id       = $data['product_id'];
    $product_name     = $data['product_name'];
    $product_category = $data['product_category']; 
    $product_code     = $data['product_code'];

    echo "<tr>
            <td>$product_name</td>
            <td>".(isset($data_list[$product_category]) ? $data_list[$product_category] : '')."</td>
            <td>$product_code</td>
            <td><a href='edit_product.php?id=$product_id'>Edit</a></td>
          </tr>";
}

echo "</table>";
?>

</body> 
</html>

<?php 
} else {
    header('location: login.php');
    exit(); // ✅ important
}
?>