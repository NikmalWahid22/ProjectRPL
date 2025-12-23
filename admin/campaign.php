<?php
include "../config/database.php";
$data = mysqli_query($conn, "SELECT * FROM campaigns");
?>

<a href="campaign_add.php">Tambah Campaign</a>
<table border="1">
<tr><th>Nama</th><th>Status</th><th>Aksi</th></tr>
<?php while ($c = mysqli_fetch_assoc($data)) { ?>
<tr>
<td><?= $c['nama_campaign'] ?></td>
<td><?= $c['status'] ?></td>
<td>
<a href="campaign_edit.php?id=<?= $c['id_campaign'] ?>">Edit</a>
<a href="campaign_delete.php?id=<?= $c['id_campaign'] ?>">Hapus</a>
</td>
</tr>
<?php } ?>
</table>
