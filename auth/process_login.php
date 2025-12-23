<?php
session_start();
require '../config/database.php';

$email = $_POST['email'];
$pass  = $_POST['password'];

$q = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($q);

if ($user && password_verify($pass, $user['password'])) {
    $_SESSION['user'] = $user;
    if ($user['role'] == 'admin') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../user/dashboard.php");
    }
} else {
    echo "Login gagal";
}
