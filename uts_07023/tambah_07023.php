<?php
// Nama: AJRUN KABIR, NIM: A12.2023.07023
include 'db_07023.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun_terbit'];

    $conn->query("INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit) VALUES ('$judul', '$pengarang', '$penerbit', '$tahun')");
    header("Location: index_07023.php");
}
?>

<form method="post">
    <h2>Tambah Buku</h2>
    Judul: <input type="text" name="judul"><br>
    Pengarang: <input type="text" name="pengarang"><br>
    Penerbit: <input type="text" name="penerbit"><br>
    Tahun Terbit: <input type="number" name="tahun_terbit"><br>
    <button type="submit">Simpan</button>
</form>
