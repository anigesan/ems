<?php
include('session.php');

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan informasi pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Error: " . mysqli_error($db));
}

$user = mysqli_fetch_assoc($result);

// Mendapatkan nilai-nilai dari form
$email = mysqli_real_escape_string($db, $_POST['email']);
$newPassword = mysqli_real_escape_string($db, $_POST['password']);

// Validasi data jika diperlukan

// Jika pengguna memasukkan kata sandi baru, enkripsi kata sandi
if (!empty($newPassword)) {
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updatePasswordQuery = "UPDATE users SET password = '$hashedPassword' WHERE id = $user_id";
    mysqli_query($db, $updatePasswordQuery);
}

// Update email
$updateEmailQuery = "UPDATE users SET email = '$email' WHERE id = $user_id";
mysqli_query($db, $updateEmailQuery);

// Redirect kembali ke halaman update_profile.php dengan pesan sukses
header("Location: update_profile.php?success=1");
exit();
?>
