<?php
require '../middleware/auth_check.php';
require '../config/database.php';

$q = mysqli_query($conn, "SELECT * FROM campaigns");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Campaign Donasi</title>
    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/dashboard.css">
</head>
<body>

<div class="campaign-wrapper">
    <h2>Daftar Campaign</h2>

    <div class="campaign-grid">

    <?php while ($c = mysqli_fetch_assoc($q)) {

        $target_amount = $c['target_amount'];
        $collected_amount = $c['collected_amount'];

        $progress = $target_amount > 0
            ? ($collected_amount / $target_amount) * 100
            : 0;

        if ($progress > 100) $progress = 100;
    ?>

        <div class="campaign-card">

            <!-- GAMBAR -->
           <?php if (!empty($c['image'])) { ?>
                <img src="../assets/image/campaigns/<?= $c['image']; ?>" class="campaign-img">
            <?php } ?>


            <!-- KONTEN -->
            <div class="campaign-content">
                <h3><?= $c['title']; ?></h3>
                <p><?= $c['description']; ?></p>

                <p class="amount">
                    <b>Rp <?= number_format($collected_amount); ?></b>
                    dari Rp <?= number_format($target_amount); ?>
                </p>

                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?= $progress; ?>%"></div>
                </div>

                <small><?= round($progress); ?>% tercapai</small>

                <a href="donate.php?id=<?= $c['id']; ?>" class="btn-donate">
                    Donasi Sekarang
                </a>
            </div>

        </div>

    <?php } ?>

    </div>
</div>

</body>
</html>
