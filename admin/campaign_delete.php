<?php
require '../config/database.php';

$id = $_GET['id'];

/* hapus payment */
mysqli_query($conn, "
    DELETE p FROM payments p
    JOIN donations d ON p.id_donation = d.id
    WHERE d.campaign_id = $id
");

/* hapus donation */
mysqli_query($conn, "
    DELETE FROM donations WHERE campaign_id = $id
");

/* hapus campaign */
mysqli_query($conn, "
    DELETE FROM campaigns WHERE id = $id
");

header("Location: dashboard.php?deleted=1");
exit;
