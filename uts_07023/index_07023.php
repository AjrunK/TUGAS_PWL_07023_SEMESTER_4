<?php
// Nama: AJRUN KABIR, NIM: A12.2023.07023
include 'db_07023.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku - AJRUN KABIR (07023)</title>
    <link rel="stylesheet" href="style_07023.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Data Buku</h1>
    <p>Nama: <strong>AJRUN KABIR</strong> | NIM: <strong>A12.2023.07023</strong></p>
    <a href="tambah_07023.php">+ Tambah Buku</a>
    
    <div style="margin: 15px 0;">
        <input type="text" id="searchInput" placeholder="Cari judul, pengarang, atau penerbit...">
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <?php
            $result = $conn->query("SELECT * FROM buku");
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
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
            ?>
        </tbody>
    </table>

    <script>
    $(document).ready(function(){
        // Fungsi pencarian
        $('#searchInput').on('keyup', function(){
            var keyword = $(this).val();
            
            $.ajax({
                url: 'search_07023.php',
                type: 'GET',
                data: {keyword: keyword},
                success: function(response){
                    $('#tableBody').html(response);
                    // Update nomor urut
                    $('#tableBody tr').each(function(index){
                        $(this).find('td:first').text(index + 1);
                    });
                }
            });
        });
    });
    </script>
</body>
</html>