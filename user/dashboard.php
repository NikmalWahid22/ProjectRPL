<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User</title>
    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/dashboard.css">
</head>
<body>

<?php
if (isset($_SESSION['alert'])) {
    echo "<script>alert('{$_SESSION['alert']}');</script>";
    unset($_SESSION['alert']);
}
?>

<div class="dashboard-wrapper">

  <!-- HEADER -->
  <div class="dashboard-header">
    <h1>Dashboard</h1>
    <p>Selamat datang di Sistem Donasi Online</p>
  </div>

  <!-- MENU CARDS -->
  <div class="dashboard-grid">

    <a href="campaigns.php" class="menu-card">
      <div class="icon"></div>
      <h3>Campaign</h3>
      <p>Lihat dan dukung campaign yang tersedia</p>
    </a>

    <a href="history.php" class="menu-card">
      <div class="icon"></div>
      <h3>Riwayat Donasi</h3>
      <p>Cek histori donasi yang sudah kamu lakukan</p>
    </a>

    <a href="../auth/logout.php" class="menu-card logout">
      <div class="icon"></div>
      <h3>Logout</h3>
      <p>Keluar dari akun</p>
    </a>

  </div>

</div>


</body>
</html>
