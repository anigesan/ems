<?php
include('session.php');

if ($_SESSION['role'] != 'admin') {
    header("Location: guest_dashboard.php");
    exit();
}

// Variabel untuk menyimpan pesan kesalahan atau sukses
$message = '';

// Fungsi untuk menghapus acara
if (isset($_GET['delete_id'])) {
    $event_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM events WHERE id = $event_id";
    if (mysqli_query($db, $delete_query)) {
        $message = "Acara berhasil dihapus.";
    } else {
        $message = "Gagal menghapus acara: " . mysqli_error($db);
    }
}

// Fungsi untuk menampilkan daftar acara
$query = "SELECT * FROM events";
$result = mysqli_query($db, $query);
?>

<!-- Headers Start -->
<?php
include 'index-layouts/header.php';
?>
<!-- Headers End -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Buat dan Kelola Acara</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Buat dan Kelola Acara</h1>
        <a href="admin_dashboard.php" class="btn btn-primary mb-3">Kembali ke Dashboard</a>

        <!-- Tampilkan pesan sukses atau kesalahan -->
        <p><?php echo $message; ?></p>
        
        <!-- Form untuk membuat acara baru -->
        <form method="post" action="create_event.php" enctype="multipart/form-data">
            <!-- Tambahkan field untuk input poster -->
            <div class="form-group">
                <label for="poster">Poster Acara:</label>
                <input type="file" name="poster" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="nama_acara">Nama Acara:</label>
                <input type="text" name="nama_acara" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="kapasitas">Kapasitas:</label>
                <input type="number" name="kapasitas" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Buat Acara</button>
        </form>

        <br>

    </div>

    <!-- Tambahkan script untuk Bootstrap JS (jika diperlukan) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Fungsi untuk membuat acara baru
if (isset($_POST['nama_acara'], $_POST['deskripsi'], $_POST['kapasitas'], $_POST['tanggal'])) {
    $nama_acara = $_POST['nama_acara'];
    $deskripsi = $_POST['deskripsi'];
    $kapasitas = $_POST['kapasitas'];
    $tanggal = $_POST['tanggal'];
    $admin_id = $_SESSION['user_id']; // Menggunakan ID admin yang sedang login

    // Proses unggahan gambar
    $poster = $_FILES['poster']['name']; // Nama file gambar
    $target_dir = "uploads/"; // Direktori penyimpanan gambar (pastikan direktori ini sudah ada)
    $target_file = $target_dir . basename($_FILES['poster']['name']);
    
    if (move_uploaded_file($_FILES['poster']['tmp_name'], $target_file)) {
        // Gambar berhasil diunggah
        $insert_query = "INSERT INTO events (nama_acara, deskripsi, kapasitas, tanggal, admin_id, poster) VALUES ('$nama_acara', '$deskripsi', $kapasitas, '$tanggal', $admin_id, '$poster')";
        if (mysqli_query($db, $insert_query)) {
            $message = "Acara berhasil dibuat.";
        } else {
            $message = "Gagal membuat acara: " . mysqli_error($db);
            echo "Error: " . $insert_query . "<br>" . mysqli_error($db);
        }
    } else {
        $message = "Gagal mengunggah gambar.";
    }
}
?>
