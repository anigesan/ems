<?php
include('session.php');

if ($_SESSION['role'] != 'admin') {
    header("Location: admin_dashboard.php");
    exit();
}

// Pastikan id acara telah diset
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Query untuk mengambil detail acara berdasarkan id
    $query = "SELECT * FROM events WHERE id = $event_id";
    $result = mysqli_query($db, $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $nama_acara = $row['nama_acara'];
        $deskripsi = $row['deskripsi'];
        $kapasitas = $row['kapasitas'];
        $tanggal = $row['tanggal'];
        $poster = $row['poster'];
    } else {
        // Handle kesalahan jika acara tidak ditemukan
        echo "Acara tidak ditemukan.";
        exit();
    }
} else {
    // Handle kesalahan jika id acara tidak disediakan
    echo "ID Acara tidak valid.";
    exit();
}


// Inisialisasi pesan
$message = "";

// Periksa apakah formulir dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui formulir
    $nama_acara = mysqli_real_escape_string($db, $_POST['nama_acara']);
    $deskripsi = mysqli_real_escape_string($db, $_POST['deskripsi']);
    $kapasitas = (int)$_POST['kapasitas'];
    $tanggal = $_POST['tanggal'];

    // Proses unggahan gambar hanya jika ada file yang diunggah
    if (!empty($_FILES['poster']['name'])) {
        $poster = $_FILES['poster']['name']; // Nama file gambar
        $target_dir = "uploads/"; // Direktori penyimpanan gambar (pastikan direktori ini sudah ada)
        $target_file = $target_dir . basename($_FILES['poster']['name']);

        if (move_uploaded_file($_FILES['poster']['tmp_name'], $target_file)) {
            // Gambar berhasil diunggah
            $update_query = "UPDATE events SET nama_acara = '$nama_acara', deskripsi = '$deskripsi', kapasitas = $kapasitas, tanggal = '$tanggal', poster = '$poster' WHERE id = $event_id";
            if (mysqli_query($db, $update_query)) {
                $message = "Acara berhasil disunting.";
            } else {
                $message = "Gagal membuat acara: " . mysqli_error($db);
            }
        } else {
            $message = "Gagal mengunggah gambar.";
        }
    } else {
        // Jika tidak ada file yang diunggah, update data acara tanpa mengubah poster
        $update_query = "UPDATE events SET nama_acara = '$nama_acara', deskripsi = '$deskripsi', kapasitas = $kapasitas, tanggal = '$tanggal' WHERE id = $event_id";
        if (mysqli_query($db, $update_query)) {
            $message = "Acara berhasil disunting.";
        } else {
            $message = "Gagal membuat acara: " . mysqli_error($db);
        }
    }
}
?>

<!-- Headers Start -->
<?php include 'index-layouts/header.php'; ?>
<!-- Headers End -->

<!DOCTYPE html>
<html>
<head>
    <title>Edit Acara: <?php echo $nama_acara; ?></title>
    <!-- Tambahkan link ke Bootstrap CSS atau CSS lainnya jika diperlukan -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .ticket {
            border: 2px solid #007BFF;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Edit Acara: <?php echo $nama_acara; ?></h1>
        <form method="post" action="edit_event.php?id=<?php echo $event_id; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_acara">Nama Acara:</label>
                <input type="text" name="nama_acara" class="form-control" value="<?php echo $nama_acara; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" required><?php echo $deskripsi; ?></textarea>
            </div>
            <div class="form-group">
                <label for="kapasitas">Kapasitas:</label>
                <input type="number" name="kapasitas" class="form-control" value="<?php echo $kapasitas; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" required>
            </div>
            <!-- Menampilkan poster saat ini -->
            <div class="form-group">
                <label for="current_poster">Poster Acara Saat Ini:</label>
                <img src="uploads/<?php echo $poster; ?>" alt="Current Poster" class="img-thumbnail">
            </div>
            <!-- Memberi opsi untuk mengganti poster -->
            <div class="form-group">
                <label for="poster">Ganti Poster Acara (kosongkan jika tidak ingin mengganti):</label>
                <input type="file" name="poster" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?php echo ($_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'guest_dashboard.php'); ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
        </form>
        <?php if (!empty($message)) : ?>
            <div class="alert alert-info mt-3"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>

<!-- Footer Start -->
<?php include 'index-layouts/footer.php'; ?>
<!-- Footer End -->
