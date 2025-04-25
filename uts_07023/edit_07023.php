<?php
// Nama: AJRUN KABIR, NIM: A12.2023.07023
include 'db_07023.php';
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM buku WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun_terbit'];

    $conn->query("UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun' WHERE id=$id");
    header("Location: index_07023.php");
}
?>

<form method="post">
    <h2>Edit Buku</h2>
    Judul: <input type="text" name="judul" value="<?= $data['judul'] ?>"><br>
    Pengarang: <input type="text" name="pengarang" value="<?= $data['pengarang'] ?>"><br>
    Penerbit: <input type="text" name="penerbit" value="<?= $data['penerbit'] ?>"><br>
    Tahun Terbit: <input type="number" name="tahun_terbit" value="<?= $data['tahun_terbit'] ?>"><br>
    <button type="submit">Update</button>
</form>
