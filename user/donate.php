<?php
require '../middleware/auth_check.php';
require '../config/database.php';

$id = $_GET['id'];
$c = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM campaigns WHERE id=$id")
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donasi</title>
    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/dashboard.css">
</head>
<body>

<div class="donate-page">

    <div class="donate-card">

        <div class="donate-header">
            <h2>Donasi Campaign</h2>
            <p><?= htmlspecialchars($c['title']); ?></p>
        </div>

        <form method="POST" action="../process/donation_process.php">

            <input type="hidden" name="campaign_id" value="<?= $c['id']; ?>">

            <div class="form-group">
                <label>Nominal Donasi (Rp)</label>
                <input type="number" name="amount" placeholder="Contoh: 50000" required>
            </div>

            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select name="payment_method" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="Bank BCA">Bank BCA</option>
                    <option value="Bank BRI">Bank BRI</option>
                    <option value="Bank Mandiri">Bank Mandiri</option>
                    <option value="Dana">Dana</option>
                    <option value="OVO">OVO</option>
                    <option value="Gopay">Gopay</option>
                </select>
            </div>

            <div class="form-group">
                <label>Pesan / Doa (Opsional)</label>
                <textarea name="message" placeholder="Tulis doa atau pesan baikmu..."></textarea>
            </div>

            <button class="btn-donate">Kirim Donasi</button>
        </form>

        <a class="btn-back" href="campaigns.php">Kembali ke Campaign</a>

    </div>

</div>

</body>
</html>
