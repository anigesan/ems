<?php
include('session.php');

if ($_SESSION['role'] == 'admin') {
    // Mendapatkan ID admin yang sedang login
    $admin_id = $_SESSION['user_id'];

    // Query untuk mendapatkan daftar acara yang dibuat oleh admin
    $eventsQuery = "SELECT id, nama_acara FROM events WHERE admin_id = $admin_id";
    $eventsResult = mysqli_query($db, $eventsQuery);

    if (!$eventsResult) {
        die("Error: " . mysqli_error($db));
    }
?>

<!-- Headers Start -->
<?php include 'index-layouts/header.php'; ?>
<!-- Headers End -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Evaluation</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan CSS khusus untuk admin_dashboard -->
    <link rel="stylesheet" href="admin-dashboard.css">
    <link rel="stylesheet" href="./CSS/admin-dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* Tambahkan gaya CSS untuk membuat tampilan tabel lebih menarik */
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table {
            border: 1px solid grey; /* Ganti warna border */
        }

        th,
        td {
            border: 1px solid grey; /* Ganti warna border */
            padding: 12px;
        }

        .img-thumbnail {
            max-width: 100px;
        }

        .bg-8a2be2 {
            background-color: #8a2be2;
        }
    </style>

</head>

<body>
    <!-- Di dalam div.container -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5">Evaluasi Acara</h1>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-8a2be2 text-white">
                <h2>Daftar Evaluasi</h2>
            </div>
            <div class="card-body">
                <?php
                while ($event = mysqli_fetch_assoc($eventsResult)) {
                    $eventId = $event['id'];
                    $eventName = $event['nama_acara'];

                    // Query untuk mendapatkan evaluasi yang terkait dengan acara
                    $evaluationsQuery = "SELECT evaluations.*, users.username
                                  FROM evaluations
                                  JOIN users ON evaluations.guest_id = users.id
                                  WHERE evaluations.event_id = $eventId";
                    $evaluationsResult = mysqli_query($db, $evaluationsQuery);

                    if (!$evaluationsResult) {
                        die("Error: " . mysqli_error($db));
                    }
                ?>
                    <div class="accordion" id="accordion<?php echo $eventId; ?>">
                        <div class="card">
                            <div class="card-header" id="heading<?php echo $eventId; ?>">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $eventId; ?>" aria-expanded="true" aria-controls="collapse<?php echo $eventId; ?>">
                                        <?php echo $eventName; ?>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse<?php echo $eventId; ?>" class="collapse" aria-labelledby="heading<?php echo $eventId; ?>" data-parent="#accordion<?php echo $eventId; ?>">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Guest</th>
                                                <th>Rating</th>
                                                <th>Komentar</th>
                                                <th>Saran</th>
                                                <th>Foto Testimoni</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $counter = 1;
                                            while ($row = mysqli_fetch_assoc($evaluationsResult)) {
                                                echo "<tr>";
                                                echo "<td>{$counter}</td>";
                                                echo "<td>{$row['username']}</td>";
                                                echo "<td>{$row['rating']}</td>";
                                                echo "<td>{$row['comment']}</td>";
                                                echo "<td>{$row['suggestion']}</td>";
                                                echo "<td><img src='{$row['testimony_photo']}' alt='Testimony Photo' class='img-thumbnail'></td>";
                                                echo "</tr>";
                                                $counter++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Tambahkan script untuk Bootstrap JS (jika diperlukan) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
