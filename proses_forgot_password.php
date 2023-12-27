<?php
include("config.php");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil data dari form reset password
$username = $_POST['username'];
$newPassword = $_POST['new_password'];

// Validasi data (misalnya, pastikan tidak ada field yang kosong)

// Enkripsi password baru
$hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Query untuk mengupdate password pengguna
$query = "UPDATE users SET password = '$hashedNewPassword' WHERE username = '$username'";

if (mysqli_query($db, $query)) {
    // Reset password berhasil
    header("Location: login.php"); // Redirect ke halaman login
} else {
    // Reset password gagal
    echo "Error: " . $query . "<br>" . mysqli_error($db);
}

// Tutup koneksi database
mysqli_close($db);
?>
