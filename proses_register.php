<?php
include("config.php");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil data dari form registrasi
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$email = $_POST['email'];

// Validasi data (misalnya, pastikan tidak ada field yang kosong)

// Enkripsi password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Query untuk menyimpan data pengguna baru ke database
$query = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$hashedPassword', '$email', '$role')";

if (mysqli_query($db, $query)) {
    // Registrasi berhasil
    header("Location: login.php"); // Redirect ke halaman login
} else {
    // Registrasi gagal
    echo "Error: " . mysqli_error($db); // Tampilkan pesan error
}

// Tutup koneksi database
mysqli_close($db);
?>
