<?php
// Include file session.php dan koneksi ke database
include('session.php');

// Pastikan form telah di-submit dan data tersedia
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id']) && isset($_POST['comment'])) {
    // Ambil data dari form
    $event_id = $_POST['event_id'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    // Query untuk menyimpan komentar ke dalam database
    $query_insert_comment = "INSERT INTO comments (event_id, user_id, comment) VALUES (?, ?, ?)";
    
    // Persiapkan statement
    $stmt = mysqli_prepare($db, $query_insert_comment);

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "iis", $event_id, $user_id, $comment);

    // Eksekusi statement
    $result_insert_comment = mysqli_stmt_execute($stmt);

    if ($result_insert_comment) {
        header("Location: commentar.php?event_id=$event_id");
        exit();
    } else {
        // Pesan kesalahan yang lebih umum
        header("Location: discussion.php?error=1");
        exit();
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    header("Location: discussion.php");
    exit();
}
?>
