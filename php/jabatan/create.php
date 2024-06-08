<?php
include '../../config/koneksi.php';
session_start();

// CREATE
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];

    if (!empty($jabatan)) {
        $stmt = $conn->prepare("INSERT INTO jabatan (nama_jabatan, deskripsi) VALUES (?, ?)");
        $stmt->bind_param("ss", $jabatan, $deskripsi);

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