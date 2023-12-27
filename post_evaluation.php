<?php
include('session.php');

include 'index-layouts/header.php';


if ($_SESSION['role'] == 'guest') {
    if (isset($_GET['id'])) {
        $event_id = $_GET['id'];

        // Pastikan $event_id valid dan acara sudah berakhir
        $query = "SELECT * FROM events WHERE id = $event_id AND tanggal < CURDATE()";
        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Validasi dan simpan data ke database
                $rating = $_POST['rating'];
                $comment = $_POST['comment'];
                $suggestion = $_POST['suggestion'];

                // Untuk menyimpan file foto testimoni, pertimbangkan menggunakan direktori yang aman
                $uploadDirectory = 'uploads/';
                $uploadedFile = $uploadDirectory . basename($_FILES['testimony_photo']['name']);

                if (move_uploaded_file($_FILES['testimony_photo']['tmp_name'], $uploadedFile)) {
                    // File berhasil diunggah, simpan ke database
                    $query = "INSERT INTO evaluations (event_id, guest_id, rating, comment, suggestion, testimony_photo)
                              VALUES ($event_id, {$_SESSION['user_id']}, $rating, '$comment', '$suggestion', '$uploadedFile')";

                    $insertResult = mysqli_query($db, $query);

                    if ($insertResult) {
                        echo '<div class="alert alert-success" role="alert">Evaluasi berhasil disimpan!</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Gagal menyimpan evaluasi: ' . mysqli_error($db) . '</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Gagal mengunggah foto testimoni.</div>';
                }
            }

            // Tampilkan formulir evaluasi dengan Bootstrap
            // ...
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/guest-dashboard.css"> <!-- Sesuaikan dengan path CSS Anda -->
    <title>Post Evaluation</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Post Evaluation</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" class="form-control" name="rating" min="1" max="5" required>
            </div>
            <div class="form-group">
                <label for="comment">Komentar:</label>
                <textarea class="form-control" name="comment" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="suggestion">Saran:</label>
                <textarea class="form-control" name="suggestion" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="testimony_photo">Foto Testimoni:</label>
                <input type="file" class="form-control-file" name="testimony_photo" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Kirim Evaluasi</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
            // ...
        } else {
            // Tampilkan pesan bahwa acara tidak dapat dievaluasi
            echo '<div class="alert alert-warning" role="alert">Acara tidak dapat dievaluasi atau ID acara tidak valid.</div>';
        }
    } else {
        // Tampilkan pesan bahwa parameter ID tidak diberikan
        echo '<div class="alert alert-danger" role="alert">Parameter ID acara tidak diberikan.</div>';
    }
} else {
    header("Location: haha.php");
    exit();
}
?>
<!-- Footer Start -->
<?php include 'index-layouts/footer.php'; ?>
<!-- Footer End -->