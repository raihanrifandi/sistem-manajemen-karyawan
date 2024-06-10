<?php
include '../../config/koneksi.php';

// Tangkap data dari form
$id_karyawan = $_POST['id_karyawan'];
$nama_karyawan = $_POST['nama_karyawan'];
$email = $_POST['email'];
$no_telepon = $_POST['no_telepon'];
$hire_date = $_POST['hire_date'];
$id_departemen = $_POST['id_departemen'];
$id_jabatan = $_POST['id_jabatan'];
$status = $_POST['status'];

// Query SQL untuk menambah data karyawan
$sql = "INSERT INTO karyawan (id_karyawan, nama_karyawan, email, no_telepon, hire_date, id_departemen, id_jabatan, status) VALUES ('$id_karyawan', '$nama_karyawan', '$email', '$no_telepon', '$hire_date', '$id_departemen', '$id_jabatan', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "Data karyawan berhasil ditambahkan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
