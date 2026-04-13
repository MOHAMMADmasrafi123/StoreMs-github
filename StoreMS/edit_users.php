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
    <title>Edit Users</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit User</h4>
                </div>

                <div class="card-body">

<?php
$user_id = $user_first_name_db = $user_last_name_db = $user_email = $user_password = '';

if (isset($_GET['id'])) {
    $getid = $_GET['id'];

    $sql = "SELECT * FROM users WHERE user_id = $getid";
    $query = $conn->query($sql);
    $data = mysqli_fetch_assoc($query);

    $user_id              = $data['user_id'];
    $user_first_name_db   = $data['user_first_name'];
    $user_last_name_db    = $data['user_last_name'];
    $user_email           = $data['user_email'];
    $user_password        = $data['user_password'];
}

if (isset($_GET['user_first_name']) && isset($_GET['user_id'])) {

    $new_user_first_name = $_GET['user_first_name'];
    $new_user_last_name  = $_GET['user_last_name'];
    $new_user_email      = $_GET['user_email'];
    $new_user_password   = $_GET['user_password'];
    $new_user_id         = $_GET['user_id'];

    $sql1 = "UPDATE users SET 
                user_first_name = '$new_user_first_name',
                user_last_name  = '$new_user_last_name',
                user_email      = '$new_user_email',
                user_password   = '$new_user_password'
            WHERE user_id = $new_user_id";

    if ($conn->query($sql1) === TRUE) {
        echo '<div class="alert alert-success">Update Successful</div>';
    } else {
        echo '<div class="alert alert-danger">Not updated: ' . $conn->error . '</div>';
    }
}
?>

<form action="" method="GET">

    <div class="mb-3">
        <label class="form-label">First Name</label>
        <input type="text" name="user_first_name"
               class="form-control"
               value="<?php echo $user_first_name_db; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" name="user_last_name"
               class="form-control"
               value="<?php echo $user_last_name_db; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="user_email"
               class="form-control"
               value="<?php echo $user_email; ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="text" name="user_password"
               class="form-control"
               value="<?php echo $user_password; ?>">
    </div>

    <input type="hidden" name="user_id"
           value="<?php echo $user_id; ?>">

    <button type="submit" class="btn btn-success w-100">
        Update User
    </button>

</form>

                </div>
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