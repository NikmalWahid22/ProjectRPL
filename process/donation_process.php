<?php
session_start();
require '../config/database.php';

$user_id = $_SESSION['user']['id'];
$campaign_id = $_POST['campaign_id'];
$amount = $_POST['amount'];
$message = $_POST['message'];
$method = $_POST['payment_method'];

/* 1. SIMPAN DONASI */
mysqli_query($conn, "
    INSERT INTO donations (user_id, campaign_id, amount, message, created_at)
    VALUES ($user_id, $campaign_id, $amount, '$message', NOW())
");

/* 2. AMBIL ID DONASI */
$donation_id = mysqli_insert_id($conn);


/* 3. SIMPAN PAYMENT */
mysqli_query($conn, "
    INSERT INTO payments (id_donation, payment_method, payment_status, payment_time)
    VALUES ($donation_id, '$method', 'pending', NOW())
");

/* 4. UPDATE TOTAL CAMPAIGN */
mysqli_query($conn, "
    UPDATE campaigns
    SET collected_amount = collected_amount + $amount
    WHERE id = $campaign_id
");

/* 5. ALERT */
$_SESSION['alert'] = 'Terima kasih! Donasi kamu sedang diproses 💚';
header("Location: ../user/dashboard.php");
exit;
