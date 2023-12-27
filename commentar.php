    <?php
    // Include file session.php dan koneksi ke database
    include('session.php');

    // Memastikan parameter event_id dikirim melalui GET
    if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
        header("Location: discussion.php"); // Redirect jika parameter tidak valid
        exit();
    }

    // Mendapatkan event_id dari parameter GET
    $event_id = mysqli_real_escape_string($db, $_GET['event_id']);

    // Query untuk mendapatkan informasi acara
    $query_event = "SELECT e.*, u.username as admin_name
                    FROM events e
                    JOIN users u ON e.admin_id = u.id
                    WHERE e.status = 'Aktif' AND e.id = $event_id";
    $result_event = mysqli_query($db, $query_event);

    if (!$result_event || mysqli_num_rows($result_event) == 0) {
        header("Location: discussion.php"); // Redirect jika event tidak ditemukan
        exit();
    }

    $row_event = mysqli_fetch_assoc($result_event);

    // Query untuk mendapatkan komentar untuk acara ini dengan urutan terbaru dulu
    $query_comments = "SELECT c.*, u.username as user_name
                    FROM comments c
                    JOIN users u ON c.user_id = u.id
                    WHERE c.event_id = $event_id
                    ORDER BY c.createdat DESC";  // Menambahkan ORDER BY untuk mengurutkan berdasarkan waktu pembuatan
    $result_comments = mysqli_query($db, $query_comments);

    if (!$result_comments) {
        die("Error: " . mysqli_error($db));
    }

    ?>

<!-- Headers Start -->
<?php
include 'index-layouts/header.php';
?>
<!-- Headers End -->

    <!DOCTYPE html>
    <html lang="en">

    <style>
        .comment-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 15px;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment-user {
            font-weight: bold;
            color: #4CAF50;
        }

        .comment-timestamp {
            color: #666;
            font-size: 12px;
        }

        .comment-text {
            margin-top: 10px;
        }

        .comment-form {
            margin-top: 20px;
        }
    </style>
    
    <head>
        <!-- Sesuaikan bagian head dengan kebutuhan Anda -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Komentar</title>
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
            <h2>Komentar untuk "<?php echo $row_event['nama_acara']; ?>"</h2>
            <div class="card mt-3">
                <div class="card-header"><?php echo $row_event['nama_acara']; ?> oleh <?php echo $row_event['admin_name']; ?>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $row_event['deskripsi']; ?></p>
                    <p class="card-text">Tanggal: <?php echo $row_event['tanggal']; ?></p>
                </div>
            </div>

            <!-- Daftar Komentar -->
            <div class="mt-4">
            <?php
            while ($row_comment = mysqli_fetch_assoc($result_comments)) {
                echo "<div class='comment-container'>";
                echo "<div class='comment-header'>";
                echo "<div class='comment-user'>{$row_comment['user_name']}</div>";
                echo "<div class='comment-timestamp'>{$row_comment['created_at']}</div>";
                echo "</div>";
                echo "<div class='comment-text'>{$row_comment['comment']}</div>";
                echo "</div>";
            }
            ?>
        </div>

            <!-- Form Komentar -->
            <div class="mt-4">
                <form action="process_comment.php" method="post">
                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                    <div class="mb-3">
                        <label for="comment" class="form-label">Tambah Komentar:</label>
                        <textarea class="form-control" id="comment" name="comment" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                </form>
            </div>
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