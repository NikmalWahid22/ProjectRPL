<?php
session_start();
require '../config/database.php';
require '../middleware/auth_check.php';

$_SESSION['alert'] = "Donasi berhasil! Terima kasih atas kebaikanmu";

// redirect
header("Location: ../user/dashboard.php");
exit;
