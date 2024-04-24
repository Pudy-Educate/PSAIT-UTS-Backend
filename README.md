## PSAIT BACKEND Repository

# SQL Syntax

CREATE TABLE mahasiswa (
nim VARCHAR(10) PRIMARY KEY,
nama VARCHAR(20),
alamat VARCHAR(40),
tanggal_lahir DATE
);

CREATE TABLE matakuliah (
kode_mk VARCHAR(10) PRIMARY KEY,
nama_mk VARCHAR(20),
sks INT(2)
);

CREATE TABLE perkuliahan (
id_perkuliahan INT(5) PRIMARY KEY AUTO_INCREMENT,
nim VARCHAR(10),
kode_mk VARCHAR(10),
nilai DOUBLE,
FOREIGN KEY (nim) REFERENCES mahasiswa(nim),
FOREIGN KEY (kode_mk) REFERENCES matakuliah(kode_mk)
);

SELECT p.nim, m.nama, m.alamat, m.tanggal_lahir, mk.kode_mk, mk.nama_mk, mk.sks, p.nilai
FROM perkuliahan p
JOIN mahasiswa m ON p.nim=m.nim
JOIN matakuliah mk ON p.kode_mk=mk.kode_mk;
