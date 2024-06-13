<?php
include '../../config/koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_proyek = $_POST['id_proyek'];

    if (!empty($id_proyek)) {
        $stmt = $conn->prepare("DELETE FROM proyek WHERE id_proyek = ?");
        $stmt->bind_param("s", $id_proyek);

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