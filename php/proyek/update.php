<?php
include '../../config/koneksi.php';

// Tangkap data dari form
$id_proyek = $_POST['id_proyek'];
$nama_proyek = $_POST['nama_proyek'];
$deskripsi = $_POST['deskripsi'];
$tanggal_mulai = $_POST['tanggal_mulai'];
$manajer_proyek = $_POST['manajer_proyek'];
$budget_proyek = $_POST['budget_proyek'];
$status = $_POST['status'];

// Validasi data
if (!empty($id_proyek) && !empty($nama_proyek) && !empty($deskripsi) && !empty($tanggal_mulai) && !empty($manajer_proyek) && !empty($budget_proyek) && !empty($status)) {
    
    // Ambil tanggal sekarang untuk tanggal_selesai jika status adalah "Selesai"
    $tanggal_selesai = null;
    if ($status === 'Selesai') {
        $tanggal_selesai = date('Y-m-d'); // Tanggal saat ini
    }

    // Query SQL untuk memperbarui data proyek
    $stmt = $conn->prepare("UPDATE proyek SET nama_proyek = ?, deskripsi = ?, tanggal_mulai = ?, tanggal_selesai = ?, manajer_proyek = ?, budget_proyek = ?, status = ? WHERE id_proyek = ?");
    
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
    } else {
        $stmt->bind_param("ssssssss", $nama_proyek, $deskripsi, $tanggal_mulai, $tanggal_selesai, $manajer_proyek, $budget_proyek, $status, $id_proyek);
        
        if ($stmt->execute()) {
            echo "Data proyek berhasil diperbarui";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo "Error: Pastikan semua field telah diisi.";
}

$conn->close();
?>
