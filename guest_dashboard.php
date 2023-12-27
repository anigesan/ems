<?php
include('session.php');

if ($_SESSION['role'] == 'guest') {
    // Ambil ID guest dari sesi
    $guest_id = $_SESSION['user_id'];

    // Query untuk mendapatkan daftar acara dan jumlah tiket yang telah dipesan oleh user
    $query = "SELECT e.*, COALESCE(b.jumlah_tiket, 0) AS jumlah_tiket
    FROM events e
    LEFT JOIN (
        SELECT event_id, SUM(jumlah_tiket) AS jumlah_tiket
        FROM bookings
        WHERE guest_id = $guest_id
        GROUP BY event_id
    ) b ON e.id = b.event_id";

    // Proses formulir pencarian
    $search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';

    if (!empty($search)) {
        $query .= " WHERE (nama_acara LIKE '%$search%' OR deskripsi LIKE '%$search%')";
    }

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
    <title>Guest Dashboard</title>
    <link rel="stylesheet" href="./CSS/guest-dashboard.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/style.css"> <!-- Tambahkan CSS khusus untuk efek 3D -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .card {
            width: 300px; /* Lebar tetap untuk setiap kartu */
            margin-bottom: 20px; /* Jarak antar kartu */
        }

        .card img {
            width: 100%;
            height: 150px; /* Tinggi tetap untuk setiap gambar */
            object-fit: cover; /* Untuk memastikan gambar tetap dalam proporsi */
        }

        .bpw-layout {
    width: 20%; /* Sesuaikan dengan lebar yang diinginkan, misalnya 100% agar mengikuti lebar kontainer */
  }
    </style>
</head>

<body>
    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-fluid w-100 h-100 overflow-hidden"
                    src="../ems/img/bg.gif"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <h3>Introducing</h3>
                    <h5>Gina</h5>
                    <p>uwuwuwuwuwuwu</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="img-fluid w-100 h-100 overflow-hidden"
                    src="../ems/img/bg.gif"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <h5>President University</h5>
                    <p>Where Tomorrow's Leaders Come Together</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="img-fluid w-100 h-100 overflow-hidden"
                    src="../ems/img/bg.gif"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <h5>President University</h5>
                    <p>Where Tomorrow's Leaders Come Together</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>

    <!-- Tampilan Efek 3D untuk Daftar Acara -->
    <div class="container">
        <div class="col-md-4 text-right">
            <form class="form-inline mt-5" action="" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Cari acara" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
            </form>
        </div>
        <div class="card-deck mt-4">
            <?php
            $count = 0; // Inisialisasi variabel hitungan
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] == 'Dibatalkan') {
                    // Skip acara dengan status "DIBATALKAN"
                    continue;
                }

                // Memotong deskripsi menjadi maksimal 3 baris
                $trimmedDescription = strlen($row['deskripsi']) > 100 ? substr($row['deskripsi'], 0, 250) . '...' : $row['deskripsi'];
            ?>
                <div class="card">
                    <img src="uploads/<?php echo $row['poster']; ?>" class="card-img-top" alt="Event Poster">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nama_acara']; ?></h5>
                        <p class="card-text"><?php echo $trimmedDescription; ?></p>
                        <p class="card-text"><small class="text-muted">Tanggal: <?php echo $row['tanggal']; ?></small></p>
                    </div>
                    <div class="card-footer">
                        <?php
                        if ($row['status'] == 'Aktif' && strtotime($row['tanggal']) < strtotime(date('Y-m-d')) && $row['jumlah_tiket'] > 0) {
                        ?>
                            <a href='post_evaluation.php?id=<?php echo $row['id']; ?>' class='btn btn-success btn-sm'>Post Evaluation</a>
                        <?php
                        }
                        ?>
                        <a href='detail_event.php?id=<?php echo $row['id']; ?>' class='btn btn-primary btn-sm'>Detail</a>
                    </div>
                </div>
            <?php
                $count++;

                if ($count % 3 == 0) {
                    echo "</div><div class='card-deck mt-4'>";
                }
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
<script>
  window.botpressWebChat.init({
      "composerPlaceholder": "Chat with bot",
      "botConversationDescription": "This chatbot was built surprisingly fast with Botpress",
      "botId": "f9da08ac-de52-4a98-8b99-8991eadcd82e",
      "hostUrl": "https://cdn.botpress.cloud/webchat/v1",
      "messagingUrl": "https://messaging.botpress.cloud",
      "clientId": "f9da08ac-de52-4a98-8b99-8991eadcd82e",
      "webhookId": "561cfaa1-ee3e-43e1-9964-28fd12720db0",
      "lazySocket": true,
      "themeName": "prism",
      "frontendVersion": "v1",
      "showPoweredBy": true,
      "theme": "prism",
      "themeColor": "#2563eb"
  });
</script>
</div>
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
