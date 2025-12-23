<?php
require '../middleware/auth_check.php';
require '../config/database.php';

$user_id = $_SESSION['user']['id'];

$q = mysqli_query($conn, "
    SELECT 
        d.id,
        c.title AS campaign,
        d.amount,
        d.message,
        d.created_at
    FROM donations d
    JOIN campaigns c ON d.campaign_id = c.id
    WHERE d.user_id = $user_id
    ORDER BY d.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Donasi</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/dashboard.css">
</head>
<body>

<div class="page-wrapper">
    <div class="history-wrapper">

        <div class="header">
            <h2>Riwayat Donasi Saya</h2>
            <p>Daftar donasi yang sudah kamu lakukan</p>
        </div>

        <?php if (mysqli_num_rows($q) == 0): ?>
            <div class="info">
                Kamu belum melakukan donasi.
            </div>
        <?php else: ?>

            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Campaign</th>
                            <th>Nominal</th>
                            <th>Pesan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php $no = 1; while ($r = mysqli_fetch_assoc($q)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($r['campaign']); ?></td>
                            <td>Rp <?= number_format($r['amount']); ?></td>
                            <td><?= $r['message'] ?: '-' ?></td>
                            <td><?= date('d M Y H:i', strtotime($r['created_at'])); ?></td>
                            <td>
                                <span class="status success">Berhasil</span>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                    </tbody>
                </table>
            </div>

        <?php endif; ?>

        <a href="dashboard.php" class="btn secondary back-btn">⬅ Kembali ke Dashboard</a>

    </div>
</div>

</body>

</html>
