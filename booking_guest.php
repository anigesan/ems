<?php
include('session.php');

if ($_SESSION['role'] == 'guest') {
    // Ambil ID guest dari sesi
    $guest_id = $_SESSION['user_id'];

    // Query untuk mendapatkan daftar acara yang telah dipesan tiket oleh guest
    $query = "SELECT e.id, e.nama_acara, e.deskripsi, e.kapasitas, e.status, e.tanggal, b.jumlah_tiket
              FROM events e
              JOIN bookings b ON e.id = b.event_id
              WHERE b.guest_id = $guest_id";

    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Error: " . mysqli_error($db));
    }
?>

<!-- Headers Start -->
<?php include 'index-layouts/header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- Headers End -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Booking List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/guest-dashboard.css">
    <style>
        .invoice {
            border: 2px solid #007BFF;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Booking List</h1>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='invoice' id='invoice_" . $row['id'] . "'>";
            echo "<h3 class='text-center'>" . $row['nama_acara'] . "</h3>";
            echo "<p><strong>Tanggal:</strong> " . $row['tanggal'] . "</p>";
            echo "<p><strong>Jumlah Tiket:</strong> " . $row['jumlah_tiket'] . "</p>";
            echo "<p class='text-center'>Tiket ini merupakan bukti pemesanan Anda.</p>";
            echo "<button class='btn btn-primary d-block mx-auto' onclick='printInvoice(\"invoice_" . $row['id'] . "\")'><i class='fa fa-print'></i> Print Invoice</button>";
            echo "</div>";
        }
        ?>
    </div>

    <!-- Moved jQuery and Bootstrap scripts to the end -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function printInvoice(id) {
            var content = document.getElementById(id).innerHTML;
            var mywindow = window.open('', 'Print', 'height=600,width=800');
            mywindow.document.write('<html><head><title>Invoice</title>');
            mywindow.document.write('</head><body>');
            mywindow.document.write(content);
            mywindow.document.write('</body></html>');
            mywindow.document.close();
            mywindow.print();
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

<!-- Footer Start -->
<?php include 'index-layouts/footer.php'; ?>
<!-- Footer End -->
