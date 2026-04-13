<?php
require('connection.php');
session_start();

$user_first_name = $_SESSION['user_first_name'] ?? '';
$user_last_name  = $_SESSION['user_last_name'] ?? '';

if(!empty($user_first_name) && !empty($user_last_name)){


if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM category WHERE category_id = $id";
    $query = $conn->query($sql);
    $data = mysqli_fetch_assoc($query);

    $category_id        = $data['category_id'];
    $category_name      = $data['category_name'];
    $category_entrydate = $data['category_entrydate'];
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $new_name = $_POST['category_name'];
    $new_date = $_POST['category_entrydate'];
    $new_id   = $_POST['category_id'];

    if(!empty($new_name) && !empty($new_date)){

        $sql1 = "UPDATE category SET 
        category_name = '$new_name',
        category_entrydate = '$new_date'
        WHERE category_id = '$new_id'";

        if($conn->query($sql1)){
            $msg = "<div class='alert alert-success'> Update Successful</div>";
        } else {
            $msg = "<div class='alert alert-danger'> Update Failed</div>";
        }

    } else {
        $msg = "<div class='alert alert-warning'>Fill all Feild</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h3>Welcome, <?php echo $user_first_name . " " . $user_last_name; ?></h3>

    <div class="card p-4 mt-3">

        <h4 class="mb-3"> Edit Category</h4>

        <?php if(isset($msg)) echo $msg; ?>

        <form method="POST">

            <label>Category Name</label>
            <input type="text" name="category_name" class="form-control mb-3"
                   value="<?php echo $category_name ?? ''; ?>" required>

            <label>Category Entry Date</label>
            <input type="date" name="category_entrydate" class="form-control mb-3"
                   value="<?php echo $category_entrydate ?? ''; ?>" required>

            <input type="hidden" name="category_id"
                   value="<?php echo $category_id ?? ''; ?>">

            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Update Category
            </button>

        </form>

    </div>

</div>

</body>
</html>

<?php 
} else {
    header('location: login.php');
}
?>