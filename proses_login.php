<?php
include("config.php");

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mencari pengguna berdasarkan username
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($db, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);

    // Memeriksa apakah username ditemukan dan password cocok
    if ($user && password_verify($password, $user['password'])) {
        // Login berhasil
        session_start();
        $_SESSION['user_id'] = $user['id']; // Tambahkan ID pengguna ke dalam sesi
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php"); // Redirect admin ke halaman admin_dashboard
        } elseif ($user['role'] == 'guest') {
            header("Location: guest_dashboard.php"); // Redirect guest ke halaman guest_dashboard
        } else {
            // Handle peran lainnya (jika ada)
        }
    } else {
        // Login gagal
        $message = "Wrong Input! Please try again.";
        echo "<script type='text/javascript'>alert('$message');";
        echo "window.location.href = 'login.php';</script>";
    }
} else {
    // Error dalam query
    echo "Error: " . $query . "<br>" . mysqli_error($db);
}

// Tutup koneksi database
mysqli_close($db);
?>