<?php
include('session.php');

if ($_SESSION['role'] == 'admin') {
    // Mendapatkan ID admin yang sedang login
    $admin_id = $_SESSION['user_id'];

    // Query untuk mendapatkan daftar acara yang telah dibuat oleh admin yang sedang login
    $query = "SELECT * FROM events WHERE admin_id = $admin_id";

    // Proses formulir pencarian
    $search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';

    if (!empty($search)) {
        $query .= " AND (nama_acara LIKE '%$search%' OR deskripsi LIKE '%$search%')";
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
    <title>Admin Dashboard wkwkw nyoba</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link rel="stylesheet" href="./CSS/admin-dashboard.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tambahkan CSS khusus untuk admin_dashboard -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .card {
            width: 400px; /* Lebar tetap untuk setiap kartu */
            margin-bottom: 20px; /* Jarak antar kartu */
        }

        .card img {
            width: 100%;
            height: 150px; /* Tinggi tetap untuk setiap gambar */
            object-fit: cover; /* Untuk memastikan gambar tetap dalam proporsi */
        }

        .status-aktif {
            color: green;
        }

        .status-tidak-aktif {
            color: red;
        }

        body {
            background-image: url('https://i.pinimg.com/originals/bb/f3/99/bbf399ef3eb7649b9cc2b69656b574af.gif');
            background-size: cover;
            background-position: center;
        }
        .bg-f3d9eb {
            background-color: #f3d9eb;
        }
    </style>

</head>

<body>
    <!-- Di dalam div.container
        <div class="row">
            <div class="col-md-7">
                <h1 class="mt-5">Selamat datang, Admin!</h1>
            </div>
            <div class="col-md-4 text-right">
                <a href="create_event.php" class="btn btn-success mt-5">Buat Acara</a>
                <a href="live_streaming.php" class="btn btn-success btn-sm ml-2 mt-5">Live Streaming</a>
            </div>
        </div> -->
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

        <div class="container mt-4">
    <div class="row">
        <div class="col-md-7">
            <h1 class="mt-5">Selamat datang, Admin!</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="create_event.php" class="btn btn-success mt-5">Buat Acara</a>
            <a href="live_streaming.php" class="btn btn-success btn-sm ml-2 mt-5">Live Streaming</a>
        </div>
        <div class="col-md-4 text-right">
            <form class="form-inline mt-5" action="" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Cari event" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
            </form>
        </div>
    </div>

    <div class="card-deck mt-4">
        <?php
        $count = 0; // Inisialisasi variabel hitungan
        while ($row = mysqli_fetch_assoc($result)) {
            // Menentukan status berdasarkan tanggal acara
            $status = ($row['tanggal'] < date('Y-m-d')) ? 'Expired' : $row['status'];

            // Tampilkan tombol-tombol dalam satu baris
            echo "<div class='col-md-4'>";
            echo "<div class='card'>";
            echo "<img src='uploads/" . $row['poster'] . "' class='card-img-top' alt='Event Poster'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $row['nama_acara'] . "</h5>";

            $trimmedDescription = substr($row['deskripsi'], 0, 150) . '...';
            echo "<p class='card-text'>" . nl2br($trimmedDescription) . "</p>";

            if (strlen($row['deskripsi']) > 100) {
                echo "<button class='btn btn-link' data-toggle='collapse' data-target='#collapseDescription" . $row['id'] . "'>See More</button>";
                echo "<div id='collapseDescription" . $row['id'] . "' class='collapse'>";
                echo "<p class='card-text'>" . nl2br($row['deskripsi']) . "</p>";
                echo "</div>";
            }

            echo "<p class='card-text'><strong>Kapasitas:</strong> " . $row['kapasitas'] . "</p>";
            echo "<p class='card-text'><strong>Status: <span class='status-" . strtolower($status) . "'>" . $status . "</span></strong></p>";
            echo "<p class='card-text'><strong>Tanggal:</strong> " . $row['tanggal'] . "</p>";
            echo "<div class='card-footer'>";
            echo "<a href='detail_event.php?id=" . $row['id'] . "' class='btn bg-f3d9eb btn-sm mr-2'><i class='bi bi-info-circle'></i></a>";
            echo "<a href='edit_event.php?id=" . $row['id'] . "' class='btn bg-f3d9eb btn-sm mr-2'><i class='bi bi-pencil'></i></a>";

            if ($status == 'Expired') {
                echo "<a href='evaluations_admin.php?id=" . $row['id'] . "' class='btn bg-f3d9eb btn-sm mr-2'><i class='bi bi-check'></i></a>";
            }

            echo "<a href='status_event.php?id=" . $row['id'] . "' class='btn bg-f3d9eb btn-sm mr-2'><i class='bi bi-x'></i></a>";
            echo "<a href='delete_event.php?id=" . $row['id'] . "' class='btn bg-f3d9eb btn-sm'><i class='bi bi-trash'></i></a>";
            echo "</div></div></div>";
            
            echo "</div>"; // Tutup div col-md-4
            $count++;
            
            if ($count % 3 == 0) {
                echo "</div><div class='card-deck mt-4'>";
            }
        }
        ?>
    </div>
</div>

    <!-- Tambahkan script untuk Bootstrap JS (jika diperlukan) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Contoh Kode Integrasi Botpress Widget -->
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
