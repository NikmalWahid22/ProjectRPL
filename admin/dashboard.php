<?php
session_start();
require '../config/database.php';
require '../auth/auth_check.php';

$q = mysqli_query($conn, "SELECT * FROM campaigns");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>

<div class="admin-wrapper">

  <div class="admin-header">
    <h2>Data Campaign</h2>
    <a href="campaign_add.php">+ Tambah Campaign</a>
    <a href="reports.php">Lapoan Donasi</a>
    <a href="users.php">Data User</a>
    <a href="adminexport.php">Export</a>
    <a href="../auth/logout.php" class="btn logout">Logout</a>
  </div>

  <div class="admin-card">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Judul</th>
          <th>Target</th>
          <th>Terkumpul</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($c = mysqli_fetch_assoc($q)) { ?>
        <tr>
          <td><?= $c['title']; ?></td>
          <td>Rp <?= number_format($c['target_amount']); ?></td>
          <td>
            <span class="badge">
              Rp <?= number_format($c['collected_amount']); ?>
            </span>
          </td>
          <td class="action">
            <a href="campaign_edit.php?id=<?= $c['id']; ?>" class="edit">Edit</a>
            <a href="campaign_delete.php?id=<?= $c['id']; ?>" class="delete"
               onclick="return confirm('Hapus campaign ini?')">
               Hapus
            </a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

</div>


</body>
</html>
