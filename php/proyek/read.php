<?php
include '../../config/koneksi.php';
session_start();

$sql = "SELECT p.id_proyek, p.nama_proyek, p.deskripsi, p.tanggal_mulai, p.tanggal_selesai, k.nama_karyawan AS manajer_proyek, p.budget_proyek, p.status
        FROM proyek p 
        JOIN karyawan k ON p.manajer_proyek = k.id_karyawan;";
        
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
