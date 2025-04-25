<?php
// Nama: AJRUN KABIR, NIM: A12.2023.07023
include 'db_07023.php';
$id = $_GET['id'];
$conn->query("DELETE FROM buku WHERE id=$id");
header("Location: index_07023.php");
?>
