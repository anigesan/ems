<?php
include('session.php');

// Memeriksa apakah pengguna adalah admin atau guest
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'guest') {
    header("Location: haha.php");
    exit();
}
?>

<!-- Headers Start -->
<?php include 'index-layouts/header.php'; ?>
<!-- Headers End -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Universitas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Three.js (Menggunakan CDN untuk Three.js) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script type="module">
        // Scene
        const scene = new THREE.Scene();

        // Camera
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 5;

        // Renderer
        const renderer = new THREE.WebGLRenderer({ alpha: true });
        updateRendererSize();  // Memanggil fungsi untuk mengatur ukuran renderer awal
        document.body.appendChild(renderer.domElement);

        // Fungsi untuk mengatur ukuran renderer
        function updateRendererSize() {
            const newWidth = window.innerWidth;
            const newHeight = window.innerHeight;

            renderer.setSize(newWidth, newHeight);
            camera.aspect = newWidth / newHeight;
            camera.updateProjectionMatrix();
        }

        window.addEventListener('resize', updateRendererSize);

        // Function to create a university-related 3D object
        function createUniversityObject() {
            // Choose between a book, graduation cap, or university building
            const geometry = Math.random() < 0.33 ? new THREE.BoxGeometry(0.5, 0.2, 0.5) :
                Math.random() < 0.66 ? new THREE.ConeGeometry(0.3, 1, 32) :
                new THREE.BoxGeometry(1, 1, 1);

            const material = new THREE.MeshBasicMaterial({ color: getRandomColor() });
            const universityObject = new THREE.Mesh(geometry, material);

            // Random position for the university object
            universityObject.position.x = (Math.random() - 0.5) * 10;
            universityObject.position.y = (Math.random() - 0.5) * 10;
            universityObject.position.z = (Math.random() - 0.5) * 10;

            scene.add(universityObject);
        }

        // Function to get a random color
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Create multiple university-related objects
        for (let i = 0; i < 10; i++) {
            createUniversityObject();
        }

        // Animation
        const animate = function () {
            requestAnimationFrame(animate);

            // Rotate all university-related objects
            scene.children.forEach(universityObject => {
                if (universityObject instanceof THREE.Mesh) {
                    universityObject.rotation.x += 0.01;
                    universityObject.rotation.y += 0.01;
                }
            });

            renderer.render(scene, camera);
        };

        animate();
    </script>

    <!-- Custom CSS -->
    <style>
    body {
        margin: 0;
        overflow: visible;
        font-family: 'Arial', sans-serif;
    }

    #background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -2;
        background-image: url('https://i.pinimg.com/originals/bb/f3/99/bbf399ef3eb7649b9cc2b69656b574af.gif');
        background-size: cover;
    }

    canvas {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        z-index: -1;
    }

    h1, p {
        text-align: center;
        color: #fff;
        position: relative;
        z-index: 1;
    }

    /* Tambahkan gaya khusus untuk membuat Three.js responsif */
    @media (max-width: 768px) {
        canvas {
            width: 100% !important;
            height: auto !important;
        }
    }
</style>
</head>

<body>
    <!-- Your existing content here -->
    <div id="background"></div>

    <div class="container mt-5">
        <h1>Tentang Universitas</h1>
        <p>Selamat datang di halaman tentang universitas. Di sini, Anda dapat mengetahui lebih lanjut tentang kami.</p>

        <!-- Pejabat -->
        <div class="row mt-5">
            <?php
            // Contoh data pejabat universitas
            $pejabat = array(
                "Rektor" => array(
                    "nama" => "Nama Rektor",
                    "deskripsi" => "Deskripsi Rektor",
                    "foto" => "../ems/img/eunha.jpg"
                ),
                "Wakil Rektor Bidang Akademik" => array(
                    "nama" => "Nama Wakil Rektor Bidang Akademik",
                    "deskripsi" => "Deskripsi Wakil Rektor Bidang Akademik",
                    "foto" => "../ems/img/iu.jpg"
                ),
                "Wakil Rektor Bidang Kemahasiswaan" => array(
                    "nama" => "Nama Wakil Rektor Bidang Kemahasiswaan",
                    "deskripsi" => "Deskripsi Wakil Rektor Bidang Kemahasiswaan",
                    "foto" => "../ems/img/suzy.jpg"
                ),
                "Nyoba" => array(
                    "nama" => "Nama Rektor",
                    "deskripsi" => "Deskripsi Rektor",
                    "foto" => "../ems/img/iu.jpg"
                ),
                "Doang" => array(
                    "nama" => "Nama Wakil Rektor Bidang Akademik",
                    "deskripsi" => "Deskripsi Wakil Rektor Bidang Akademik",
                    "foto" => "../ems/img/suzy.jpg"
                ),
                "WKWKW" => array(
                    "nama" => "Nama Wakil Rektor Bidang Kemahasiswaan",
                    "deskripsi" => "Deskripsi Wakil Rektor Bidang Kemahasiswaan",
                    "foto" => "../ems/img/eunha.jpg"
                ),
                // Tambahkan pejabat lain sesuai kebutuhan
            );

            // Menampilkan setiap pejabat
            foreach ($pejabat as $jabatan => $data) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                
                // Kartu luar dengan ukuran tetap
                echo '<div class="card-body">';
                echo '<img src="' . $data['foto'] . '" class="card-img-top" alt="' . $jabatan . '" style="width: 100%; height: auto;">';
                echo '<h5 class="card-title">' . $jabatan . '</h5>';
                echo '<p class="card-text" style="color: #000;">' . $data['deskripsi'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <!-- End Pejabat -->
    </div>
    <!-- Your existing content here -->

    <!-- End Organisasi -->
    </div>
    </div>


    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-hMlA8f+qF2Phj1gE3Dns6Z9FbxGGoG6QCJoOKb9pB8jhFlCfOFgUpX2YtqEIl7vX"
        crossorigin="anonymous"></script>
</body>

</html>

<!-- Footer Start -->
<?php include 'index-layouts/footer.php'; ?>
<!-- Footer End -->
