<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// TAMBAH DATA CUSTOMER
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $device = $_POST['device'];
    $keluhan = $_POST['keluhan'];

    mysqli_query($conn, "INSERT INTO customers (nama, phone, alamat, device, keluhan)
    VALUES ('$nama', '$phone', '$alamat', '$device', '$keluhan')");

    header('Location: admin_crud.php');
    exit;
}

// HAPUS DATA
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM customers WHERE id=$id");

    header('Location: admin_crud.php');
    exit;
}

// EDIT DATA
if (isset($_POST['update'])) {
    $id = (int) $_POST['id'];
    $nama = $_POST['nama'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $device = $_POST['device'];
    $keluhan = $_POST['keluhan'];

    mysqli_query($conn, "UPDATE customers SET
        nama='$nama',
        phone='$phone',
        alamat='$alamat',
        device='$device',
        keluhan='$keluhan'
        WHERE id=$id");

    header('Location: admin_crud.php');
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM customers ORDER BY id DESC");
?><!DOCTYPE html><html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin CRUD - Asia Computer</title>
<style>
body{font-family:Arial;background:#0b0b0b;color:#fff;padding:30px;}
.container{max-width:1100px;margin:auto;}
h1{color:#C00000;margin-bottom:20px;}
form, table{background:#111;padding:20px;border-radius:14px;border:1px solid #333;}
input, textarea{width:100%;padding:12px;margin-bottom:10px;border:none;border-radius:8px;}
button{background:#C00000;color:#fff;border:none;padding:12px 20px;border-radius:8px;cursor:pointer;}
table{width:100%;border-collapse:collapse;margin-top:20px;}
th,td{padding:12px;border-bottom:1px solid #222;text-align:left;}
a{color:#fff;text-decoration:none;}
.action a{margin-right:10px;}
</style>
</head>
<body>
<div class="container">
<h1>Admin CRUD Customer</h1><form method="POST">
    <input type="hidden" name="id" value="">
    <input type="text" name="nama" placeholder="Nama Customer" required>
    <input type="text" name="phone" placeholder="Nomor WhatsApp" required>
    <input type="text" name="alamat" placeholder="Alamat" required>
    <input type="text" name="device" placeholder="Jenis Device" required>
    <textarea name="keluhan" placeholder="Keluhan Device" required></textarea><button type="submit" name="tambah">Tambah Data</button>

</form><table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Phone</th>
        <th>Device</th>
        <th>Keluhan</th>
        <th>Aksi</th>
    </tr><?php while($row = mysqli_fetch_assoc($data)) : ?>
<tr>
    <td><?= $row['id']; ?></td>
    <td><?= $row['nama']; ?></td>
    <td><?= $row['phone']; ?></td>
    <td><?= $row['device']; ?></td>
    <td><?= $row['keluhan']; ?></td>
    <td class="action">
        <a href="?hapus=<?= $row['id']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>

</table></div>
</body>
</html>
