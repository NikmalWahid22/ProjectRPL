<?php
require '../middleware/auth_check.php';
require '../config/database.php';

/* ======================
   PROCESS FORM
====================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $target = $_POST['target_amount'];

    // UPLOAD GAMBAR
    $img_name = time() . '_' . $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $folder = '../assets/image/campaigns/';
    move_uploaded_file($tmp, $folder . $img_name);

    // INSERT DATABASE
    mysqli_query($conn, "
        INSERT INTO campaigns 
        (title, description, target_amount, collected_amount, image)
        VALUES 
        ('$title', '$description', '$target', 0, '$img_name')
    ");

    // REDIRECT BIAR GA DOUBLE SUBMIT
    header("Location: dashboard.php?updated=1");
    exit;

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Campaign</title>
    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>

<div class="admin-form-wrapper">
  <div class="admin-form-card">

    <h2>Tambah Campaign</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Judul Campaign</label>
        <input type="text" name="title" required>

        <label>Deskripsi</label>
        <textarea name="description" required></textarea>

        <label>Target Donasi</label>
        <input type="number" name="target_amount" required>

        <label>Gambar Campaign</label>
        <input type="file" name="image" accept="image/*" required>

        <button class="btn primary">Simpan Campaign</button>
        <a href="campaigns.php" class="btn secondary">Batal</a>

    </form>

  </div>
</div>

</body>
</html>
