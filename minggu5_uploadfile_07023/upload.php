<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gambar = $_FILES['gambar'];
    $ext_allowed = ['jpg', 'jpeg', 'png'];
    $mime_allowed = ['image/jpeg', 'image/png'];
    $max_size = 1 * 1024 * 1024;

    $ext = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
    $mime = mime_content_type($gambar['tmp_name']);

    if (!in_array($ext, $ext_allowed) || !in_array($mime, $mime_allowed)) {
        die("Tipe file tidak diperbolehkan.");
    }

    if ($gambar['size'] > $max_size) {
        die("Ukuran file terlalu besar. Maksimum 1MB.");
    }

    list($width, $height) = getimagesize($gambar['tmp_name']);
    $new_width = $width > 1024 ? 1024 : $width;
    $new_height = floor($height * ($new_width / $width));

    $resized = imagecreatetruecolor($new_width, $new_height);
    $src = ($mime == 'image/png') ? imagecreatefrompng($gambar['tmp_name']) : imagecreatefromjpeg($gambar['tmp_name']);
    imagecopyresampled($resized, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    $filename = time() . ".$ext";
    $filepath = "uploads/$filename";
    imagejpeg($resized, $filepath, 90);

    $thumb_width = 150;
    $thumb_height = floor($new_height * ($thumb_width / $new_width));
    $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
    imagecopyresampled($thumb, $resized, 0, 0, 0, 0, $thumb_width, $thumb_height, $new_width, $new_height);
    $thumbpath = "uploads/thumbs/thumb_$filename";
    imagejpeg($thumb, $thumbpath, 90);

    $size = filesize($filepath);
    $stmt = $conn->prepare("INSERT INTO gambar (filename, filepath, thumbpath, width, height, size) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiii", $filename, $filepath, $thumbpath, $new_width, $new_height, $size);
    $stmt->execute();

    echo "Upload berhasil. <a href='galeri.php'>Lihat Galeri</a>";
}
?>

<form method="POST" enctype="multipart/form-data">
    <label>Pilih Gambar (jpg/png, max 1MB):</label><br>
    <input type="file" name="gambar" required><br><br>
    <input type="submit" value="Upload">
</form>
