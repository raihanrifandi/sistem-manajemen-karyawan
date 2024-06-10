<?php
include '../../config/koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_karyawan = $_POST['id_karyawan'];

    if (!empty($id_karyawan)) {
        $stmt = $conn->prepare("DELETE FROM karyawan WHERE id_karyawan = ?");
        $stmt->bind_param("s", $id_karyawan);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Data berhasil dihapus"]);
        } else {
            echo json_encode(["error" => "Gagal menghapus data"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["error" => "ID tidak boleh kosong"]);
    }
}
?>