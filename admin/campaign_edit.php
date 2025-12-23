<?php
require '../auth/auth_check.php';
require '../config/database.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM campaigns WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title       = $_POST['title'];
    $description = $_POST['description'];
    $target      = $_POST['target_amount'];

    // DEFAULT GAMBAR LAMA
    $image = $row['image'];

    // CEK JIKA UPLOAD GAMBAR BARU
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . $_FILES['image']['name'];
        $tmp   = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "../assets/image/campaigns/" . $image);
    }

    mysqli_query($conn, "
        UPDATE campaigns SET
            title='$title',
            description='$description',
            target_amount='$target',
            image='$image'
        WHERE id=$id
    ");

    header("Location: dashboard.php?updated=1");
    exit;

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Campaign</title>
    <link rel="stylesheet" href="../assets/base.css">
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>

<div class="admin-form-wrapper">
  <div class="admin-form-card">

    <h2>Edit Campaign</h2>

    <form method="POST"
      enctype="multipart/form-data"
      action="campaign_edit.php?id=<?= $row['id']; ?>">

    <label>Judul Campaign</label>
    <input type="text" name="title"
           value="<?= $row['title']; ?>" required>

    <label>Deskripsi</label>
    <textarea name="description" required>
        <?= $row['description']; ?>
    </textarea>

    <label>Target Donasi</label>
    <input type="number" name="target_amount"
           value="<?= $row['target_amount']; ?>" required>

    <label>Gambar Saat Ini</label>
    <img src="../assets/image/campaigns/<?= $row['image']; ?>"
         class="preview-img">

    <label>Ganti Gambar (opsional)</label>
    <input type="file" name="image">

    <button class="btn primary">Update Campaign</button>
</form>
    
  </div>
</div>

</body>
</html>
