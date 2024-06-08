<?php
include '../../config/koneksi.php';
session_start();

$sql = "SELECT id_jabatan, nama_jabatan, deskripsi FROM jabatan";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();

echo json_encode($data);

?>