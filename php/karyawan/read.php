<?php
include '../../config/koneksi.php';
session_start();

$sql = "SELECT k.id_karyawan, k.nama_karyawan, k.email, k.no_telepon, k.hire_date, d.nama_departemen, j.nama_jabatan, k.status
        FROM karyawan k 
        JOIN departemen d ON k.id_departemen = d.id_departemen 
        JOIN jabatan j ON k.id_jabatan = j.id_jabatan";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
