<?php
include '../../config/koneksi.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_timp = $_POST['id_timp'];

    if (!empty($id_timp)) {
        $stmt = $conn->prepare("DELETE FROM tim_proyek WHERE id_timp = ?");
        $stmt->bind_param("i", $id_timp);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Data berhasil dihapus"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menghapus data"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "ID tidak boleh kosong"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode request tidak valid"]);
}

$conn->close();
?>
