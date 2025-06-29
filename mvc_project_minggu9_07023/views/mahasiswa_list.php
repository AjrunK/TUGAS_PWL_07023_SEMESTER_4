<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
</head>
<body>
<h1>Daftar Mahasiswa</h1>
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>NIM</th>
</tr>
<?php foreach($data as $mhs): ?>
<tr>
    <td><?= $mhs['id']; ?></td>
    <td><?= $mhs['nama']; ?></td>
    <td><?= $mhs['nim']; ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>