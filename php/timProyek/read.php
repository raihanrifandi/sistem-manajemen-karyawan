<?php
include '../../config/koneksi.php';
session_start();

$sql = "
    SELECT 
        p.id_proyek, 
        p.nama_proyek, 
        k1.nama_karyawan AS manajer_proyek, 
        k2.nama_karyawan AS nama_anggota,
        tp.id_timp
    FROM 
        proyek p
    JOIN 
        karyawan k1 ON p.manajer_proyek = k1.id_karyawan
    LEFT JOIN 
        tim_proyek tp ON p.id_proyek = tp.id_proyek
    LEFT JOIN 
        karyawan k2 ON tp.id_karyawan = k2.id_karyawan
    WHERE 
        tp.id_karyawan IS NOT NULL
";

// Eksekusi query
$result = $conn->query($sql);

$data = array();
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "Error: " . $conn->error;
}

// Mengembalikan data dalam format JSON
echo json_encode($data);

$conn->close();
?>
