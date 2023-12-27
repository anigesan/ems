<?php
include('session.php');

if ($_SESSION['role'] == 'admin') {
    // Mendapatkan ID admin yang sedang login
    $admin_id = $_SESSION['user_id'];

    // Query untuk mendapatkan daftar booking untuk acara yang telah dibuat oleh admin yang sedang login
    $query = "SELECT e.id as event_id, e.nama_acara, e.tanggal, e.kapasitas, 
              GROUP_CONCAT(u.username SEPARATOR '<br>') as guests,
              GROUP_CONCAT(b.jumlah_tiket SEPARATOR '<br>') as jumlah_tiket,
              SUM(b.jumlah_tiket) as total_tiket,
              (SUM(b.jumlah_tiket) + e.kapasitas) as total_kapasitas
              FROM events e
              LEFT JOIN bookings b ON e.id = b.event_id
              LEFT JOIN users u ON b.guest_id = u.id
              WHERE e.admin_id = $admin_id
              GROUP BY e.id";
    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Error: " . mysqli_error($db));
    }

    // Proses data untuk grafik
    $labels = array();
    $data = array();
    $total_ratio_display = array(); // Array untuk menyimpan tampilan total rasio

    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row['nama_acara'];
        $data[] = intval($row['jumlah_tiket']);

        // Kolom total_ratio menunjukkan rasio jumlah tiket yang dibeli terhadap kapasitas acara
        $total_tiket = $row['total_tiket'];
        $total_kapasitas = $row['total_kapasitas'];
        $total_ratio = $total_tiket > 0 ? "$total_tiket/$total_kapasitas" : "N/A";
        $total_ratio_display[] = $total_ratio;
    }
    $bookingData = array(
        'labels' => $labels,
        'data' => $data
    );
?>

<!-- Headers Start -->
<?php include 'index-layouts/header.php'; ?>

<!-- Headers End -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Booking List</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tambahkan script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Booking List</h1>

        <!-- Tambahkan canvas untuk grafik di atas tabel -->
        <canvas id="bookingChart" width="800" height="400"></canvas>

        <!-- Tambahkan tombol untuk mencetak PDF -->
        <button onclick="printTable()" class="btn btn-primary mt-3">Print PDF</button>

        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                <h2>Daftar Booking</h2>
            </div>
            <div class="card-body">
                <table id="bookingTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Event</th>
                            <th>Tanggal Event</th>
                            <th>Guests</th>
                            <th>Jumlah Tiket</th>
                            <th>Kapasitas Acara</th>
                            <th>Total Rasio</th> <!-- Tambahkan kolom untuk menampilkan total rasio -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        mysqli_data_seek($result, 0); // Kembali ke awal hasil query
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$counter}</td>";
                            echo "<td>{$row['nama_acara']}</td>";
                            echo "<td>{$row['tanggal']}</td>";
                            echo "<td>{$row['guests']}</td>";
                            echo "<td>{$row['jumlah_tiket']}</td>";
                            echo "<td>{$row['kapasitas']}</td>";
                            echo "<td>{$total_ratio_display[$counter-1]}</td>"; // Tampilkan total rasio
                            echo "</tr>";
                            $counter++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambahkan script untuk Bootstrap JS (jika diperlukan) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- ... Kode lainnya ... -->

    <script>
    // Ambil data dari PHP dan ubah menjadi objek JavaScript
    var bookingData = <?php echo json_encode($bookingData); ?>;
    var totalRatioData = <?php echo json_encode($total_ratio_display); ?>;

    // Ambil elemen canvas
    var ctx = document.getElementById('bookingChart').getContext('2d');

    // Ubah data total rasio menjadi desimal
    var decimalTotalRatioData = totalRatioData.map(function (ratio) {
        if (ratio === 'N/A') {
            return 0;
        } else {
            var parts = ratio.split('/');
            return parseFloat(parts[0]) / parseFloat(parts[1]);
        }
    });

    // Buat grafik menggunakan Chart.js
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: bookingData.labels,
            datasets: [{
                label: 'Total Rasio',
                data: decimalTotalRatioData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Fungsi untuk mencetak tabel dan membuat file PDF
    function printTable() {
        // Mencetak tabel ke file PDF dengan fungsi print bawaan browser
        window.print();
    }
</script>


</body>

</html>

<?php
} else {
    header("Location: haha.php");
    exit();
}
?>

<!-- Headers Start -->
<?php include 'index-layouts/footer.php'; ?>
<!-- Headers End -->
