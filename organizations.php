<?php
include('session.php');

// Memeriksa apakah pengguna adalah admin atau guest
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'guest') {
    header("Location: haha.php");
    exit();
}

// Query untuk mendapatkan daftar admin dan acara yang mereka buat
$query = "SELECT u.id AS admin_id, u.username, e.id AS event_id, e.nama_acara, e.deskripsi, e.tanggal, e.status, e.kapasitas
          FROM users u
          LEFT JOIN events e ON u.id = e.admin_id
          WHERE u.role = 'admin'";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Error: " . mysqli_error($db));
}
?>

<!-- Headers Start -->
<?php include 'index-layouts/header.php'; ?>
<!-- Headers End -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Organizations</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/organizations.css"> <!-- Sesuaikan dengan path file CSS yang sesuai -->

    <style>
        /* Tambahkan gaya khusus jika diperlukan */
        .admin-card {
            margin-bottom: 20px;
        }

        .event-list {
            margin-top: 10px;
        }

        .nav-link {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>List of Administrators and Events</h1>

        <?php
        // Memisahkan hasil query menjadi kelompok berdasarkan nama admin
        $admins = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $adminId = $row['admin_id'];
            $adminName = $row['username'];

            if (!isset($admins[$adminId])) {
                $admins[$adminId] = [
                    'name' => $adminName,
                    'events' => [],
                ];
            }

            if (!empty($row['event_id'])) {
                $admins[$adminId]['events'][] = [
                    'event_id' => $row['event_id'],
                    'nama_acara' => $row['nama_acara'],
                    'deskripsi' => $row['deskripsi'],
                    'tanggal' => $row['tanggal'],
                    'status' => $row['status'],
                    'kapasitas' => $row['kapasitas'],
                ];
            }
        }

        // Menampilkan card untuk setiap admin
        foreach ($admins as $adminId => $adminData) {
            echo "<div class='card admin-card'>";
            echo "<div class='card-header'>";
            echo "<span class='nav-link' data-toggle='collapse' data-target='#collapse_$adminId'>$adminData[name]</span>";
            echo "</div>";
            echo "<div class='collapse' id='collapse_$adminId'>";
            echo "<div class='card-body'>";

            // Menampilkan daftar acara yang dibuat oleh admin
            if (!empty($adminData['events'])) {
                echo "<h5 class='card-title'>Events:</h5>";
                echo "<ul class='list-group event-list'>";
                foreach ($adminData['events'] as $event) {
                    echo "<li class='list-group-item'>";
                    echo "<strong>$event[nama_acara]</strong><br>";
                    echo "<strong>Deskripsi:</strong> $event[deskripsi]<br>";
                    echo "<strong>Tanggal:</strong> $event[tanggal]<br>";
                    echo "<strong>Status:</strong> $event[status]<br>";
                    echo "<strong>Kapasitas:</strong> $event[kapasitas]<br>";
                    echo "<a href='detail_event.php?id=$event[event_id]' class='btn btn-primary btn-sm mt-2'>Detail Event</a>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='card-text'>No events created by this admin.</p>";
            }

            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>

    </div>

    <!-- Tambahkan script untuk Bootstrap JS (jika diperlukan) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<!-- Headers Start -->
<?php include 'index-layouts/footer.php'; ?>
<!-- Headers End -->
