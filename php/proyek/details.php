<?php

include '../../config/koneksi.php';

if (isset($_GET['id_proyek'])) {
    $id_proyek = $_GET['id_proyek'];

    // Get project details
    $projectQuery = "SELECT * FROM proyek WHERE id_proyek = '$id_proyek'";
    $projectResult = mysqli_query($conn, $projectQuery);
    $projectData = mysqli_fetch_assoc($projectResult);

    // Get team members
    $teamQuery = "SELECT karyawan.nama_karyawan FROM tim_proyek 
                  JOIN karyawan ON tim_proyek.id_karyawan = karyawan.id_karyawan 
                  WHERE tim_proyek.id_proyek = '$id_proyek'";
    $teamResult = mysqli_query($conn, $teamQuery);
    $teamMembers = [];
    while ($row = mysqli_fetch_assoc($teamResult)) {
        $teamMembers[] = $row['nama_karyawan'];
    }

    $response = [
        'project' => $projectData,
        'team' => $teamMembers
    ];

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'ID Proyek tidak ditemukan']);
}
?>
