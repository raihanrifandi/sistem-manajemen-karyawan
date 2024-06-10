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

// Query SQL untuk memperbarui data karyawan
$sql = "UPDATE karyawan SET nama_karyawan = '$nama_karyawan', email = '$email', no_telepon = '$no_telepon', hire_date = '$hire_date', id_departemen = '$id_departemen', id_jabatan = '$id_jabatan', status = '$status' WHERE id_karyawan = '$id_karyawan'";

if ($conn->query($sql) === TRUE) {
    echo "Data karyawan berhasil diperbarui";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
