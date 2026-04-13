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
    <title>Add User</title>
	<?php include 'links.php'; ?>
</head>
<body>
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
if(isset($_GET['user_first_name'])){

    $user_first_name    = $_GET['user_first_name'];
    $user_last_name     = $_GET['user_last_name'];
    $user_email         = $_GET['user_email'];
	$user_password         = $_GET['user_password'];


    $sql = "INSERT INTO users
    (user_first_name, user_last_name, user_email, user_password )
    VALUES ('$user_first_name', '$user_last_name', '$user_email', '$user_password')";

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

    User's First Name :<br>
    <input type="text" name="user_first_name"><br><br>

    User's Last Name :<br>
    <input type="text" name="user_last_name"><br><br>
	
	User's Email :<br>
    <input type="email" name="user_email"><br><br>
	
	User's Password :<br>
    <input type="password" name="user_password"><br><br>

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