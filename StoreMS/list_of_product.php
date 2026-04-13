<?php
require('connection.php');
session_start();

$user_first_name = $_SESSION['user_first_name'] ?? '';
$user_last_name  = $_SESSION['user_last_name'] ?? '';

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

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h3 class="mb-3">
        Welcome, <?php echo $user_first_name . " " . $user_last_name; ?>
    </h3>

    <h4 class="mb-4">Product List</h4>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Code</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $sql = "SELECT * FROM product";                              
        $query = $conn->query($sql);

        while($data = mysqli_fetch_assoc($query)){
            $product_id       = $data['product_id'];
            $product_name     = $data['product_name'];
            $product_category = $data['product_category']; 
            $product_code     = $data['product_code'];

            echo "<tr>
                <td>$product_name</td>
                <td>".($data_list[$product_category] ?? 'N/A')."</td>
                <td>$product_code</td>
                <td>
                    <a href='edit_product.php?id=$product_id' class='btn btn-sm btn-primary'>
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
    exit();
}
?>