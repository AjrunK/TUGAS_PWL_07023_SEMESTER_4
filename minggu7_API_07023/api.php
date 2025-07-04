<?php
header("Content-Type: application/json");
require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    $sql = "SELECT * FROM mahasiswa";
    $result = $koneksi->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    echo json_encode($data);
    break;

  case 'POST':
    $input = json_decode(file_get_contents("php://input"), true);
    $nama = $input['nama'];
    $nim = $input['nim'];
    $jurusan = $input['jurusan'];
    $sql = "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES ('$nim', '$nama', '$jurusan')";
    echo json_encode(['status' => $koneksi->query($sql)]);
    break;

  case 'PUT':
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'];
    $nama = $input['nama'];
    $jurusan = $input['jurusan'];
    $sql = "UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan' WHERE id=$id";
    echo json_encode(['status' => $koneksi->query($sql)]);
    break;

  case 'DELETE':
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'];
    $sql = "DELETE FROM mahasiswa WHERE id=$id";
    echo json_encode(['status' => $koneksi->query($sql)]);
    break;

  default:
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    break;
}
?>