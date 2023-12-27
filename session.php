<?php
include('config.php');
session_start();

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit(); // Hentikan eksekusi lebih lanjut jika tidak ada sesi login
} else {
    // Sesi login ada, lanjutkan sesuai kebutuhan
    $user_check = $_SESSION['username'];

    $ses_sql = mysqli_query($db, "SELECT username FROM users WHERE username = '$user_check'");

    if (!$ses_sql) {
        die("Error: " . mysqli_error($db)); // Tambahkan penanganan error jika query gagal
    }

    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

    $login_session = $row['username'];
}
?>
