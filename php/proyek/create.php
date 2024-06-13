<?php
include '../../config/koneksi.php';

// Tangkap data dari form
$id_proyek = $_POST['id_proyek'];
$nama_proyek = $_POST['nama_proyek'];
$deskripsi = $_POST['deskripsi'];
$tanggal_mulai = $_POST['tanggal_mulai'];
$manajer_proyek = $_POST['id_karyawan'];
$budget_proyek = $_POST['budget_proyek'];
$status = $_POST['status'];

// Query SQL untuk menambah data proyek
$sql = "INSERT INTO proyek (id_proyek, nama_proyek, deskripsi, tanggal_mulai, manajer_proyek, budget_proyek, status) VALUES ('$id_proyek', '$nama_proyek', '$deskripsi', '$tanggal_mulai', '$manajer_proyek', '$budget_proyek','$status')";

if ($conn->query($sql) === TRUE) {
    echo "Data Proyek berhasil ditambahkan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
