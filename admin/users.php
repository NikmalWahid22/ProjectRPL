<?php
require '../auth/admin_check.php';
require '../config/database.php';

$q = mysqli_query($conn, "
    SELECT id, name, email, role, created_at
    FROM users
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>

<div class="admin-wrapper">

  <div class="admin-header">
    <h2>Data User</h2>
    <a href="dashboard.php">⬅ Dashboard</a>
  </div>

  <div class="admin-card">
    <table class="admin-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th>Tanggal Daftar</th>
        </tr>
      </thead>
      <tbody>

      <?php if (mysqli_num_rows($q) == 0): ?>
        <tr>
          <td colspan="5" style="text-align:center;">Belum ada user</td>
        </tr>
      <?php endif; ?>

      <?php $no=1; while ($u = mysqli_fetch_assoc($q)) { ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= htmlspecialchars($u['name']); ?></td>
          <td><?= htmlspecialchars($u['email']); ?></td>
          <td>
            <span class="badge <?= $u['role']=='admin'?'badge-admin':'badge-user'; ?>">
              <?= $u['role']; ?>
            </span>
          </td>
          <td><?= date('d M Y', strtotime($u['created_at'])); ?></td>
        </tr>
      <?php } ?>

      </tbody>
    </table>
  </div>

</div>

</body>
</html>
