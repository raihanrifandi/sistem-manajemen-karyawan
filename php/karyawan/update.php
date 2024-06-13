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

// Jika status yang akan diubah menjadi 'tidak aktif'
if ($status == 'Tidak Aktif') {
    // Query untuk memeriksa apakah karyawan terlibat dalam proyek yang aktif
    $checkQuery = "
        SELECT COUNT(*) AS count 
        FROM tim_proyek tp 
        JOIN proyek p ON tp.id_proyek = p.id_proyek 
        WHERE tp.id_karyawan = ? AND p.status != 'selesai'
    ";
    $stmt = $conn->prepare($checkQuery);
    if ($stmt === false) {
        echo json_encode(["error" => "Error preparing statement: " . $conn->error]);
        exit();
    }
    $stmt->bind_param("s", $id_karyawan);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        // Karyawan terlibat dalam proyek yang aktif
        echo json_encode(["error" => "Karyawan ini terlibat dalam proyek aktif dan tidak dapat dinonaktifkan untuk sementara waktu."]);
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();
}

// Query SQL untuk memperbarui data karyawan
$sql = "
    UPDATE karyawan 
    SET nama_karyawan = ?, email = ?, no_telepon = ?, hire_date = ?, id_departemen = ?, id_jabatan = ?, status = ? 
    WHERE id_karyawan = ?
";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(["error" => "Error preparing statement: " . $conn->error]);
    exit();
}
$stmt->bind_param("ssssiiss", $nama_karyawan, $email, $no_telepon, $hire_date, $id_departemen, $id_jabatan, $status, $id_karyawan);

if ($stmt->execute()) {
    echo json_encode(["success" => "Data karyawan berhasil diperbarui"]);
} else {
    echo json_encode(["error" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
