<?php
require('connection.php');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body{
            margin:0;
            padding:0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .box{
            background:white;
            padding:35px;
            width:320px;
            border-radius:12px;
            box-shadow:0 10px 25px rgba(0,0,0,0.3);
            text-align:center;
        }

        h2{
            margin-bottom:20px;
            color:#333;
        }

        input{
            width:100%;
            padding:12px;
            margin:10px 0;
            border:1px solid #ddd;
            border-radius:8px;
            outline:none;
            transition:0.3s;
            font-size:14px;
        }

        input:focus{
            border-color:#667eea;
            box-shadow:0 0 8px rgba(102,126,234,0.4);
        }

        input[type="submit"]{
            background: linear-gradient(to right, #667eea, #764ba2);
            color:white;
            border:none;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
        }

        input[type="submit"]:hover{
            transform: scale(1.05);
        }

        .error{
            color:red;
            margin-bottom:10px;
        }
    </style>
</head>

<body>

<div class="box">

<?php
if(isset($_POST['user_email'])){

    $user_email    = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    
    $user_email    = mysqli_real_escape_string($conn, $user_email);
    $user_password = mysqli_real_escape_string($conn, $user_password);

    $sql = "SELECT * FROM users 
            WHERE user_email = '$user_email' 
            AND user_password = '$user_password'";

    $query = $conn->query($sql);

    if ($query && mysqli_num_rows($query) > 0){

        $data = mysqli_fetch_array($query);

        $_SESSION['user_first_name'] = $data['user_first_name'];
        $_SESSION['user_last_name']  = $data['user_last_name'];

        header('Location: index.php');
        exit();

    } else {
        echo "<div class='error'>Invalid Email or Password</div>";
    }
}
?>

<h2>Login</h2>

<form method="POST" autocomplete="off">

    <input type="email" name="user_email" placeholder="Enter Email">

    <input type="password" name="user_password" placeholder="Enter Password" autocomplete="new-password">

    <input type="submit" value="Log in">

</form>

</div>

</body>
</html>