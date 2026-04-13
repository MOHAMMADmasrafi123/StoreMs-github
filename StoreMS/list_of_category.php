<?php
session_start();

if(empty($_SESSION['user_first_name']) || empty($_SESSION['user_last_name'])){
    header('location: login.php');
    exit();
}

require('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>List of Category</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h2 class="mb-4">
        Welcome, <?php echo $_SESSION['user_first_name'] . " " . $_SESSION['user_last_name']; ?>
    </h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Category</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $sql = "SELECT * FROM category";
        $query = $conn->query($sql);

        while($data = mysqli_fetch_assoc($query)){
            $category_id        = $data['category_id'];
            $category_name      = $data['category_name'];
            $category_entrydate = $data['category_entrydate'];

            echo "<tr>
                    <td>$category_name</td>
                    <td>$category_entrydate</td>
                    <td>
                        <a href='edit_category.php?id=$category_id' class='btn btn-sm btn-primary'>
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