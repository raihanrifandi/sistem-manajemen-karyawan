<?php
include '../../config/koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_username = $_POST['username'];
    $form_password = $_POST['password'];

    // Persiapkan statement untuk memilih data dari tabel admin
    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $form_username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stored_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Verifikasi kata sandi tanpa hash
        if ($form_password === $stored_password) {
            $_SESSION['username'] = $form_username;
            header("Location: ../../jabatan_page.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Password yang anda masukkan salah!";
            header("Location: ../../login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Username tidak ditemukan!";
        header("Location: ../../login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
