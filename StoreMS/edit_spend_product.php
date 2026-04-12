<?php
require('connection.php');	
require('my_function.php');

  session_start();
   $user_first_name = $_SESSION['user_first_name'];
   $user_last_name = $_SESSION['user_last_name'];
	 
	 if(!empty($user_first_name) && ! empty($user_last_name )){

?>

<!DOCTYPE html>
<html>  
<head>
    <title>Edit Spend Product</title>                                                                           
</head>              
<body>

<?php
$spend_product_name = '';
$spend_product_quantity = '';
$spend_product_entry_date = '';
$spend_product_id = '';
 
if(isset($_GET['id'])){
    $getid = $_GET['id'];

    $sql = "SELECT * FROM spend_product WHERE spend_product_id = $getid";
    $query = $conn->query($sql);
    $data = mysqli_fetch_assoc($query);

    $spend_product_id          = $data['spend_product_id'];
    $spend_product_name        = $data['spend_product_name'];
    $spend_product_quantity    = $data['spend_product_quantity'];
    $spend_product_entry_date  = $data['spend_product_entry_date'];
}


if(isset($_GET['spend_product_name']) && !empty($_GET['spend_product_id'])) {
    $new_spend_product_name       = $_GET['spend_product_name'];
    $new_spend_product_quantity   = $_GET['spend_product_quantity'];
    $new_spend_product_entry_date = $_GET['spend_product_entry_date'];
    $new_spend_product_id         = (int)$_GET['spend_product_id']; 

    $sql1 = "UPDATE spend_product SET 
                spend_product_name       = '$new_spend_product_name',
                spend_product_quantity   = '$new_spend_product_quantity',
                spend_product_entry_date = '$new_spend_product_entry_date'
                WHERE spend_product_id   = $new_spend_product_id";

    if($conn->query($sql1) === TRUE){
        echo 'Update Successful';
    }else{
        echo "Not update: ".$conn->error;
    }
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
    
    Product :<br>
    <select name="spend_product_name">
<?php
$sql = "SELECT * FROM product"; 
$query = $conn->query($sql);

while($data = mysqli_fetch_array($query)){
    $data_id   = $data['product_id'];
    $data_name = $data['product_name'];
?>   
    <option value='<?php echo $data_id?>' <?php if($spend_product_name == $data_id){echo 'selected';} ?>> 
        <?php echo $data_name ?>
    </option>
<?php } ?>
    </select><br><br> 
    
    Product Quantity :<br>
    <input type="number" name="spend_product_quantity" value="<?php echo $spend_product_quantity; ?>"> <br><br>   
    
    Entry Date :<br>
    <input type="date" name="spend_product_entry_date" value="<?php echo $spend_product_entry_date; ?>"> <br><br>     
    
    <input type="hidden" name="spend_product_id" value="<?php echo $spend_product_id; ?>">    
    
    <input type="submit" value="submit">
</form>

</body> 
</html>
<?php 
	 } else {
		 header('location: login.php');
	 }
	 ?> 