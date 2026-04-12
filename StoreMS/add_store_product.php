<?php
require('connection.php');	
require ('my_function.php');

  session_start();
   $user_first_name = $_SESSION['user_first_name'];
   $user_last_name = $_SESSION['user_last_name'];
	 
	 if(!empty($user_first_name) && ! empty($user_last_name )){

?>

<!DOCTYPE html>

<html>  
<head>
    <title>Store Product</title>    
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
if(isset($_GET['store_product_name'])){
     
    $store_product_name         = $_GET['store_product_name'];
    $store_product_quantity     = $_GET['store_product_quantity'];
    $store_product_entry_date   = $_GET['store_product_entry_date'];
   
    
    $sql = "INSERT INTO store_product 
    (store_product_name, store_product_quantity, store_product_entry_date) 
    VALUES ('$store_product_name', '$store_product_quantity', '$store_product_entry_date')";
    
   if($conn->query($sql)== TRUE){
	   echo 'Data Inserted';
   }else{
	   echo 'Data not inserted';
   }
}
?>

<?php
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
    
    Product :<br>
    <select name="store_product_name">
        <?php
         data_list('product', 'product_id', 'product_name');
        ?>
    </select><br><br> 
    
    Product Quantity :<br>
    <input type="text" name="store_product_quantity"><br><br> 
    
    Store Entry Date :<br>
    <input type="date" name="store_product_entry_date"><br><br>
    
    <input type="submit" value="submit">
</form>
						</div><!-- End of Container--> 
							
					</div><!--@end of right-->
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