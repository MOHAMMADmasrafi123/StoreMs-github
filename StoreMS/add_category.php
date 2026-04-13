<?php
$hostname= 'localhost';
$username= 'root';
$password= '';
$dbname= 'store_db';

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo 'Sounds perfect';
}

session_start();

$user_first_name = $_SESSION['user_first_name'] ?? '';
$user_last_name = $_SESSION['user_last_name'] ?? '';

if (!empty($user_first_name) && !empty($user_last_name)) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="container bg-light">
	 <div class="container-foulid border-bottom border-success"><!-- top bar -->
	 <?php include('topbar.php');?>
	 </div> <!-- end of top bar -->
	 
	 <div class="container-foulid">
	 <div class="row">
	 <div class="col-sm-3 bg-lihght p-0 m-0"> <!-- left bar -->
	 <?php include('leftbar.php');?>
	 </div> <!-- end of left bar -->
	 
	    <div class="col-sm-9 border-start border-success"><!-- right bar -->
	    <?php
    if (isset($_GET['category_name'])) {

    $category_name = $_GET['category_name'];
    $category_entrydate = $_GET['category_entrydate'];

    $sql = "INSERT INTO category (category_name, category_entrydate)
            VALUES ('$category_name', '$category_entrydate')";

    if ($conn->query($sql) === TRUE) {
        echo 'Data Inserted!';
    } else {
        echo 'Data not Inserted!';
    }
}
?>

  <form action="add_category.php" method="GET">
    Category :<br>
    <input type="text" name="category_name"><br><br>

    Category Entry Date :<br>
    <input type="date" name="category_entrydate"><br><br>

    <input type="submit" value="submit">
</form>
		</div><!-- end of right bar -->
	    </div>
	 </div>
	 <div class="container-foulid border-top border-success">
	 <?php include('bottombar.php');?>
	 </div>
</body>
</html>

<?php
} else {
    header('location: login.php');
}
?>