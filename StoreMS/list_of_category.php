<?php
session_start();

// session check
if(empty($_SESSION['user_first_name']) || empty($_SESSION['user_last_name'])){
    header('location: login.php');
    exit();
}

// database connection
require('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>List of Category</title>
</head>
<body>

<h2>Welcome, <?php echo $_SESSION['user_first_name'] . " " . $_SESSION['user_last_name']; ?></h2>

<?php

$sql = "SELECT * FROM category";
$query = $conn->query($sql);

echo "<table border='1'>
<tr>
    <th>Category</th>
    <th>Date</th>
    <th>Action</th>
</tr>";

while($data = mysqli_fetch_assoc($query)){
    $category_id        = $data['category_id'];
    $category_name      = $data['category_name'];
    $category_entrydate = $data['category_entrydate'];

    echo "<tr>
            <td>$category_name</td>
            <td>$category_entrydate</td>
            <td><a href='edit_category.php?id=$category_id'>Edit</a></td>
          </tr>";
}

echo "</table>";
?>

</body>
</html>