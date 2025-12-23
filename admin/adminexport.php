<?php
require '../auth/admin_check.php';
require '../config/database.php';

/* HEADER EXCEL */
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_donasi.xls");

/* QUERY DATA */
$q = mysqli_query($conn, "
    SELECT 
    u.name AS donatur,
    c.title AS campaign,
    d.amount,
    p.payment_method,
    p.payment_status,
    p.payment_time
FROM payments p
JOIN donations d ON p.id_donation = d.id
JOIN users u ON d.user_id = u.id
JOIN campaigns c ON d.campaign_id = c.id
ORDER BY p.payment_time DESC

");
?>

<table border="1" cellpadding="8" cellspacing="0">
    <tr style="background:#f1f5f9; font-weight:bold;">
        <th>No</th>
        <th>Nama Donatur</th>
        <th>Campaign</th>
        <th>Nominal</th>
        <th>Metode</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>

    <?php $no = 1; while ($r = mysqli_fetch_assoc($q)): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $r['donatur']; ?></td>
        <td><?= $r['campaign']; ?></td>
        <td><?= "'Rp " . number_format($r['amount'], 0, ',', '.'); ?></td>
        <td><?= strtoupper($r['payment_method']); ?></td>
        <td><?= ucfirst($r['payment_status']); ?></td>
        <td><?= date('d-m-Y H:i', strtotime($r['payment_time'])); ?></td>
    </tr>
    <?php endwhile; ?>
</table>
