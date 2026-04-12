<?php
  require('connection.php');
  session_start();
   $user_first_name = $_SESSION['user_first_name'];
   $user_last_name = $_SESSION['user_last_name'];
	 
	 if(!empty($user_first_name) && ! empty($user_last_name )){

?>

<!DOCTYPE html>

<html>
<head>
    <title>Add Product</title>
	<?php include 'links.php'; ?>
</head>              
<body>
		<div class="container bg-light">
			<div class="container-foulid border-bottom border-success"><!--topbar-->
				<?php include('topbar.php'); ?>
			</div><!--@end topbar-->
			<div class="container-foulid">
				<div class="row">
					<div class="col-sm-3 bg-light p-0 m-0"><!--left bar-->
						<?php include('leftbar.php'); ?>
					</div><!--@end of left-->
					<div class="col-sm-9 border-start border-success"><!--right bar-->
						<div class="container p-4 m-4">
						   <?php 
if(isset($_GET['product_name'], $_GET['product_category'], $_GET['product_code'], $_GET['product_entry_date'])){
    
    $product_name        = $_GET['product_name'];
    $product_category    = $_GET['product_category'];
    $product_code        = $_GET['product_code'];
    $product_entry_date  = $_GET['product_entry_date'];
    
    $sql = "INSERT INTO product 
    (product_name, product_category, product_code, product_entry_date) 
    VALUES 
    ('$product_name', '$product_category', '$product_code', '$product_entry_date')";
    
    $conn->query($sql);
}
?>

<?php
$sql = "SELECT * FROM category";
$query = $conn->query($sql); 
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
    
    Product :<br>
    <input type="text" name="product_name"><br><br>  

    Product Category:<br>
    <select name="product_category">
        <?php
        while($data = mysqli_fetch_array($query)){
            $category_id   = $data['category_id'];
            $category_name = $data['category_name'];
            
            echo "<option value='$category_id'>$category_name</option>";
        }
        ?>
    </select><br><br> 
    
    Product Code :<br>
    <input type="text" name="product_code"><br><br> 
    
    Product Entry Date :<br>
    <input type="date" name="product_entry_date"><br><br>
    
    <input type="submit" value="submit">
</form>
				</div><!--@end of row-->
			</div>
			<div class="container-foulid border-top border-success">
				<?php include('bottombar.php'); ?>
			</div>
		</div><!--@end of container-->

</body> 
</html>
<?php 
	 } else {
		 header('location: login.php');
	 }
	 ?> 