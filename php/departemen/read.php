<?php
include '../../config/koneksi.php';
session_start();

$sql = "SELECT id_departemen, nama_departemen, deskripsi FROM departemen";
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