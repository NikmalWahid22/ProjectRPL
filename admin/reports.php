<?php
require '../auth/admin_check.php';
require '../config/database.php';

/* TOTAL DONASI */
$total = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT SUM(amount) AS total FROM donations")
);

/* TOTAL TRANSAKSI */
$count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM donations")
);

/* DONASI PER CAMPAIGN */
$per_campaign = mysqli_query($conn, "
    SELECT c.title, SUM(d.amount) AS total
    FROM donations d
    JOIN campaigns c ON d.campaign_id = c.id
    GROUP BY c.id
");

/* DETAIL DONASI */
$detail = mysqli_query($conn, "
    SELECT d.amount, d.created_at, u.name, c.title
    FROM donations d
    JOIN users u ON d.user_id = u.id
    JOIN campaigns c ON d.campaign_id = c.id
    ORDER BY d.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Donasi</title>
    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>

<div class="admin-wrapper">

  <div class="admin-header">
    <h2>Laporan Donasi</h2>
    <a href="dashboard.php">⬅ Kembali</a>
  </div>

  <!-- RINGKASAN -->
  <div class="report-summary">
    <div class="summary-card">
      <h4>Total Donasi</h4>
      <p>Rp <?= number_format($total['total'] ?? 0); ?></p>
    </div>

    <div class="summary-card">
      <h4>Total Transaksi</h4>
      <p><?= $count['total']; ?></p>
    </div>
  </div>

  <!-- DONASI PER CAMPAIGN -->
  <div class="admin-card">
    <h3>Donasi per Campaign</h3>

    <table class="admin-table">
      <thead>
        <tr>
          <th>Campaign</th>
          <th>Total Donasi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($per_campaign)) { ?>
        <tr>
          <td><?= $row['title']; ?></td>
          <td>Rp <?= number_format($row['total']); ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <br>

  <!-- DETAIL DONASI -->
  <div class="admin-card">
    <h3>Detail Transaksi</h3>

    <table class="admin-table">
      <thead>
        <tr>
          <th>Nama Donatur</th>
          <th>Campaign</th>
          <th>Jumlah</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($detail)) { ?>
        <tr>
          <td><?= $row['name']; ?></td>
          <td><?= $row['title']; ?></td>
          <td>Rp <?= number_format($row['amount']); ?></td>
          <td><?= date('d M Y H:i', strtotime($row['created_at'])); ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

</div>

</body>
</html>

