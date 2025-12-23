<?php
require '../config/database.php';

$name     = $_POST['name'];
$email    = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Email sudah terdaftar');
        window.location='register.php';
    </script>";
    exit;
}

mysqli_query($conn,
    "INSERT INTO users (name,email,password,role)
     VALUES ('$name','$email','$password','user')"
);

header("Location: login.php");
