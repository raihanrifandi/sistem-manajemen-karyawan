<?php
include '../../config/koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jabatan = $_POST['id_jabatan'];

    if (!empty($id_jabatan)) {
        $stmt = $conn->prepare("DELETE FROM jabatan WHERE id_jabatan = ?");
        $stmt->bind_param("i", $id_jabatan);

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