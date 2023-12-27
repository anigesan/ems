<?php
include('session.php');

if ($_SESSION['role'] != 'guest') {
    header("Location: guest_dashboard.php");
    exit();
}

if (isset($_POST['event_id'], $_POST['jumlah_tiket'])) {
    $event_id = $_POST['event_id'];
    $jumlah_tiket = $_POST['jumlah_tiket'];
    $guest_id = $_SESSION['user_id'];

    // Pemeriksaan jumlah tiket harus lebih dari 0
    if ($jumlah_tiket < 1) {
        echo "<script>alert('Jumlah tiket harus lebih dari 0.'); window.history.go(-1);</script>";
    } else {
        // Query untuk memeriksa kapasitas tersedia
        $capacity_query = "SELECT kapasitas, nama_acara, tanggal FROM events WHERE id = $event_id";
        $result = mysqli_query($db, $capacity_query);

        if ($result && $row = mysqli_fetch_assoc($result)) {
            $kapasitas = $row['kapasitas'];
            $nama_acara = $row['nama_acara'];
            $tanggal = $row['tanggal'];

            // Periksa apakah kapasitas cukup untuk memesan tiket
            if ($kapasitas >= $jumlah_tiket) {
                // Mulai transaksi
                mysqli_begin_transaction($db);

                // Query untuk memasukkan data pemesanan tiket
                $insert_query = "INSERT INTO bookings (guest_id, event_id, jumlah_tiket) VALUES ($guest_id, $event_id, $jumlah_tiket)";

                // Query untuk mengurangi kapasitas acara
                $update_query = "UPDATE events SET kapasitas = kapasitas - $jumlah_tiket WHERE id = $event_id";

                // Eksekusi query
                $booking_result = mysqli_query($db, $insert_query);
                $update_result = mysqli_query($db, $update_query);

                if ($booking_result && $update_result) {
                    // Commit transaksi jika berhasil
                    mysqli_commit($db);

                    // Tampilkan invoice seperti tiket dengan desain Bootstrap
                    echo '<!DOCTYPE html>
                    <html>
                    <head>
                        <title>Invoice Tiket</title>
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
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="ticket">
                                        <h3 class="text-center">' . $nama_acara . '</h3>
                                        <p><strong>Tanggal:</strong> ' . $tanggal . '</p>
                                        <p><strong>Jumlah Tiket:</strong> ' . $jumlah_tiket . '</p>
                                        <p class="text-center">Tiket ini merupakan bukti pemesanan Anda.</p>
                                    </div>
                                </div>
                            </div>
                            <a href="' . ($_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'guest_dashboard.php') . '" class="btn btn-primary mt-3 d-block mx-auto">Kembali ke Dashboard</a>
                        </div>
                    </body>
                    </html>';
                } else {
                    // Rollback transaksi jika ada kesalahan
                    mysqli_rollback($db);
                    echo "Gagal memesan tiket: " . mysqli_error($db);
                }
            } else {
                // Pesan jika kapasitas tidak mencukupi
                echo "Kapasitas tidak mencukupi untuk memesan tiket.";
            }
        } else {
            echo "Gagal memesan tiket: " . mysqli_error($db);
        }
    }
} else {
    echo "Permintaan tidak valid.";
}
?>
