<?php
require('connection.php');
session_start();

$user_first_name = $_SESSION['user_first_name'] ?? '';
$user_last_name  = $_SESSION['user_last_name'] ?? '';

if (!empty($user_first_name) && !empty($user_last_name)) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>List of Users</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

   >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">


<div class="bg-primary text-white py-3 shadow-sm">
    <div class="container">
        <h4 class="mb-0">
            Welcome, <?php echo $user_first_name . " " . $user_last_name; ?>
        </h4>
    </div>
</div>

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">User List</h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $sql = "SELECT * FROM users";
                    $query = $conn->query($sql);

                    while ($data = mysqli_fetch_assoc($query)) {

                        $user_id    = $data['user_id'];
                        $first_name = $data['user_first_name'];
                        $last_name  = $data['user_last_name'];
                        $email      = $data['user_email'];
                    ?>
                        <tr>
                            <td><?php echo $first_name; ?></td>
                            <td><?php echo $last_name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td>
                                <a href="edit_users.php?id=<?php echo $user_id; ?>"
                                   class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>

<?php
} else {
    header('location: login.php');
}
?>