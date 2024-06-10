<?php
include 'config/koneksi.php';

$sql_karyawan = "SELECT COUNT(*) as total FROM karyawan";
$result_karyawan = $conn->query($sql_karyawan);
$row_karyawan = $result_karyawan->fetch_assoc();
$total_karyawan = $row_karyawan['total'];

$conn->close();
?>
