<?php
include('session.php');

if ($_SESSION['role'] != 'admin') {
    header("Location: admin_dashboard.php");
    exit();
}

if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Query untuk mengubah status acara menjadi "Dibatalkan"
    $cancel_query = "UPDATE events SET status = 'Dibatalkan' WHERE id = $event_id";

    $result = mysqli_query($db, $cancel_query);

    if ($result) {
        // Redirect ke admin_dashboard.php atau halaman lain sesuai kebutuhan
        header("Location: admin_dashboard.php");
    } else {
        echo "Gagal membatalkan acara: " . mysqli_error($db);
    }
} else {
    echo "ID Acara tidak valid.";
}
?>
