<?php
include('session.php');

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
        $status = $row['status'];

        // Pengecekan apakah acara sudah kedaluwarsa
        $tanggal_sekarang = date("Y-m-d");
        if ($tanggal < $tanggal_sekarang) {
            $status = "Expired";
        }
    } else {
        // Handle kesalahan jika acara tidak ditemukan
        echo "Acara tidak ditemukan.";
    }
} else {
    // Handle kesalahan jika id acara tidak disediakan
    echo "ID Acara tidak valid.";
}
?>

<!-- Headers Start -->
<?php
include 'index-layouts/header.php';
?>
<!-- Headers End -->

<!DOCTYPE html>
<html>
<head>
    <title>Detail Acara: <?php echo $nama_acara; ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/detail-event.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5"><?php echo $nama_acara; ?></h1>
        <div class="row">
            <div class="col-md-6">
                <!-- Tampilkan gambar poster acara -->
                <img src="uploads/<?php echo $poster; ?>" alt="<?php echo $nama_acara; ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <p class="mt-4"><strong>Deskripsi:</strong> <?php echo nl2br($deskripsi); ?></p>
                <p><strong>Kapasitas:</strong> <?php echo $kapasitas; ?></p>
                <p><strong>Tanggal:</strong> <?php echo $tanggal; ?></p>
                <p><strong>Status:</strong> <?php echo $status; ?></p> <!-- Menampilkan status acara -->

                <?php
                if ($status != "Dibatalkan" && $status != "Expired" && $_SESSION['role'] == 'guest') { // Hanya jika status bukan "Dibatalkan" atau "Expired" dan peran pengguna adalah "guest"
                ?>
                    <form method="post" action="process_booking.php">
                        <div class="form-group">
                            <label for="jumlah_tiket">Jumlah Tiket:</label>
                            <input type="number" name="jumlah_tiket" class="form-control" required>
                        </div>
                        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                        <button type="submit" class="btn btn-success">Pesan Tiket</button>
                    </form>
                <?php
                } elseif ($status == "Expired") {
                    echo '<p>Acara sudah kedaluwarsa. Pemesanan tiket tidak tersedia.</p>';
                }
                ?>

                <a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin_dashboard.php' : 'guest_dashboard.php'; ?>" class="btn btn-primary mt-3" style="margin-bottom: 20px;">Kembali ke Daftar Acara</a>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <?php
        if ($_SESSION['role'] == 'admin') {
            // Query untuk mendapatkan daftar pesanan tiket untuk acara ini dengan informasi tamu
            $queryPesanan = "SELECT bookings.*, users.username AS nama_pengunjung FROM bookings 
                             INNER JOIN users ON bookings.guest_id = users.id 
                             WHERE bookings.event_id = $event_id";
            $resultPesanan = mysqli_query($db, $queryPesanan);

            if ($resultPesanan && mysqli_num_rows($resultPesanan) > 0) {
                echo '<h4>Daftar Orang yang Sudah Booking Tiket:</h4>';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">Nama Pengunjung</th>';
                echo '<th scope="col">Jumlah Tiket</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($rowPesanan = mysqli_fetch_assoc($resultPesanan)) {
                    echo '<tr>';
                    echo '<td>' . $rowPesanan['nama_pengunjung'] . '</td>';
                    echo '<td>' . $rowPesanan['jumlah_tiket'] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>Tidak ada pesanan tiket untuk acara ini.</p>';
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!-- Footer Start -->
<?php include 'index-layouts/footer.php'; ?>
<!-- Footer End -->
