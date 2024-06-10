<?php
include '../../config/koneksi.php';
session_start();

// CREATE
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departemen = $_POST['departemen'];
    $deskripsi = $_POST['deskripsi'];

    if (!empty($departemen)) {
        $stmt = $conn->prepare("INSERT INTO departemen (nama_departemen, deskripsi) VALUES (?, ?)");
        $stmt->bind_param("ss", $departemen, $deskripsi);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Data berhasil disimpan"]);
        } else {
            echo json_encode(["error" => "Gagal menyimpan data"]);
        }

        // Menutup query
        $stmt->close();
    } else {
        echo json_encode(["error" => "Field tidak boleh kosong"]);
    }
}

?>