
CREATE DATABASE IF NOT EXISTS kampus;
USE kampus;

CREATE TABLE IF NOT EXISTS mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(20),
  nama VARCHAR(100),
  jurusan VARCHAR(100)
);

INSERT INTO mahasiswa (nim, nama, jurusan) VALUES
('A12.2023.07023', 'AJRUN KABIR', 'Teknik Informatika');
