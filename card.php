<?php
include 'config/koneksi.php';

$sql_karyawan = "SELECT COUNT(*) as total FROM karyawan";
$result_karyawan = $conn->query($sql_karyawan);
$row_karyawan = $result_karyawan->fetch_assoc();
$total_karyawan = $row_karyawan['total'];

$sql_proyek = "SELECT COUNT(*) as total FROM proyek";
$result_proyek = $conn->query($sql_proyek);
$row_proyek = $result_proyek->fetch_assoc();
$total_proyek = $row_proyek['total'];

$sql_departemen = "SELECT COUNT(*) as total FROM departemen";
$result_departemen = $conn->query($sql_departemen);
$row_departemen = $result_departemen->fetch_assoc();
$total_departemen = $row_departemen['total'];

$conn->close();
?>
