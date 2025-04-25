<?php
include 'db_07023.php';

$keyword = $_GET['keyword'] ?? '';
$output = '';

if(!empty($keyword)){
    $stmt = $conn->prepare("SELECT * FROM buku 
                           WHERE judul LIKE ? 
                           OR pengarang LIKE ? 
                           OR penerbit LIKE ?");
    $searchTerm = "%$keyword%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
} else {
    $stmt = $conn->prepare("SELECT * FROM buku");
}

$stmt->execute();
$result = $stmt->get_result();

$no = 1;
while($row = $result->fetch_assoc()){
    $output .= "<tr>
                    <td>$no</td>
                    <td>{$row['judul']}</td>
                    <td>{$row['pengarang']}</td>
                    <td>{$row['penerbit']}</td>
                    <td>{$row['tahun_terbit']}</td>
                    <td>
                        <a href='edit_07023.php?id={$row['id']}'>Edit</a> |
                        <a href='hapus_07023.php?id={$row['id']}' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
                    </td>
                </tr>";
    $no++;
}

echo $output;
$stmt->close();
$conn->close();
?>