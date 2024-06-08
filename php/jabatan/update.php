<?php
include '../../config/koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'update') {
    $id_jabatan = $_POST['id_jabatan'];
    $jabatan = $_POST['nama_jabatan'];
    $deskripsi = $_POST['deskripsi'];

    if (!empty($jabatan)) {
        $stmt = $conn->prepare("UPDATE jabatan SET nama_jabatan = ?, deskripsi = ? WHERE id_jabatan = ?");
        $stmt->bind_param("ssi", $jabatan, $deskripsi, $id_jabatan);

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
