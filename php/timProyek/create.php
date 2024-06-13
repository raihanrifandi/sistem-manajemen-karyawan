

<?php
include '../../config/koneksi.php';
session_start();

// Tangkap data dari form
$id_proyek = $_POST['id_proyek'];
$nama_proyek = $_POST['nama_proyek'];
$manajer_proyek = $_POST['manajer_proyek'];
$id_karyawan = $_POST['id_karyawan'];

// Validasi data
if (!empty($id_proyek) && !empty($id_karyawan)) {
    // Query untuk memeriksa apakah karyawan sudah terdaftar dalam proyek yang sama
    $checkQuery = "
        SELECT * FROM tim_proyek 
        WHERE id_proyek = ? AND id_karyawan = ?
    ";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $id_proyek, $id_karyawan);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Karyawan sudah terdaftar dalam proyek yang sama
        echo json_encode(["error" => "Karyawan telah terdaftar pada proyek ini"]);
    } else {
        // Karyawan belum terdaftar, lakukan penambahan
        $insertQuery = "
            INSERT INTO tim_proyek (id_proyek, id_karyawan)
            VALUES (?, ?)
        ";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ss", $id_proyek, $id_karyawan);
        
        if ($stmt->execute()) {
            echo json_encode(["success" => "Anggota telah berhasil ditambahkan ke proyek ini!"]);
        } else {
            echo json_encode(["error" => "Terjadi kesalahan saat menambahkan data."]);
        }
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "Pastikan semua field telah diisi."]);
}

$conn->close();
?>

