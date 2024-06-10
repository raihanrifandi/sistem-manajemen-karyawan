<?php
include '../../config/koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_departemen = $_POST['id_departemen'];

    if (!empty($id_departemen)) {
        $stmt = $conn->prepare("DELETE FROM departemen WHERE id_departemen = ?");
        $stmt->bind_param("i", $id_departemen);

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