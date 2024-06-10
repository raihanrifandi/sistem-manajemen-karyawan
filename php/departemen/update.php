<?php
include '../../config/koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'update') {
    $id_departemen = $_POST['id_departemen'];
    $departemen = $_POST['nama_departemen'];
    $deskripsi = $_POST['deskripsi'];

    if (!empty($departemen)) {
        $stmt = $conn->prepare("UPDATE departemen SET nama_departemen = ?, deskripsi = ? WHERE id_departemen = ?");
        $stmt->bind_param("ssi", $departemen, $deskripsi, $id_departemen);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Data berhasil diupdate"]);
        } else {
            echo json_encode(["error" => "Gagal mengupdate data"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["error" => "Field tidak boleh kosong"]);
    }
}

?>
