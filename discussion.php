<?php
// Include file session.php dan koneksi ke database
include('session.php');

// Cek peran pengguna
if ($_SESSION['role'] == 'admin') {
    // Query untuk mendapatkan semua acara yang dibuat oleh admin
    $query = "SELECT e.*, u.username as admin_name
              FROM events e
              JOIN users u ON e.admin_id = u.id
              WHERE e.status = 'Aktif' AND e.admin_id = {$_SESSION['user_id']}";
} elseif ($_SESSION['role'] == 'guest') {
    // Query untuk mendapatkan semua acara yang telah dibook oleh guest
    $query = "SELECT e.*, u.username as admin_name
              FROM events e
              JOIN users u ON e.admin_id = u.id
              JOIN bookings b ON e.id = b.event_id
              WHERE e.status = 'Aktif' AND b.guest_id = {$_SESSION['user_id']}";
} else {
    header("Location: haha.php"); // Sesuaikan dengan halaman yang sesuai untuk role yang tidak diizinkan
    exit();
}

$result = mysqli_query($db, $query);

if (!$result) {
    die("Error: " . mysqli_error($db));
}
?>

<!-- Header Start -->
<?php
include 'index-layouts/header.php';
?>
<!-- Header End -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Sesuaikan bagian head dengan kebutuhan Anda -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Discussion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>
    <!-- Sesuaikan bagian body dengan kebutuhan Anda -->
    <header>
        <!-- Header code seperti yang sudah Anda miliki -->
    </header>

    <div class="container mt-4">
        <h2>Discussion</h2>
        <?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='card mt-3'>";
    echo "<div class='card-header'>{$row['nama_acara']} oleh {$row['admin_name']}</div>";
    echo "<div class='card-body'>";
    echo "<p class='card-text'>{$row['deskripsi']}</p>";
    echo "<p class='card-text'>Tanggal: {$row['tanggal']}</p>";
    
    // Perbaikan: Tambahkan parameter event_id ke URL commentar.php
    echo "<a href='commentar.php?event_id={$row['id']}' class='btn btn-primary'>Komentar</a>";

    echo "</div>";
    echo "</div>";
}
?>

    </div>

    <!-- Script JS dan Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-eAWRxyiXu9f5uMpdXjzbxVcz/8c+3L1NvgJ5eJ4lRqKhTfYQgJ8FeT9ZG0fXCVxn"
        crossorigin="anonymous"></script>
</body>

</html>

<!-- Footer Start -->
<?php
include 'index-layouts/footer.php';
?>
<!-- Footer End -->