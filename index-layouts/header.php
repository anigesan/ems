<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
    <!--Google Fonts-->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- End Bootstrap CSS -->

    <style>
        header {
            position: sticky;
            top: 0;
            background-color: #fff; /* Sesuaikan dengan warna latar belakang header Anda */
            z-index: 1;
        }
        .navbar-nav .nav-item {
            border-right: 1px solid #8a2be2; /* Warna garis pemisah (ungu) */
            padding-right: 10px; /* Menambahkan ruang di sebelah kanan garis pemisah */
            padding-left: 10px; /* Menambahkan ruang di sebelah kanan garis pemisah */
        }

        .navbar-nav .nav-item:last-child {
            border-right: none; /* Menghapus garis pemisah untuk elemen terakhir */
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .logo-img {
            width: 170px; /* Sesuaikan lebar logo sesuai kebutuhan */
            height: auto; /* Biarkan ketinggian mengikuti proporsi asli logo */
            margin-right: 10px; /* Sesuaikan margin sesuai kebutuhan */
        }

        .navbar-brand h2 {
            color: #8a2be2; /* Warna ungu */
        }

        .navbar-nav .nav-link:hover {
            color: #8a2be2 !important; /* Warna ungu saat dihover */
        }

        .dropdown-menu {
            background-color: #6c757d; /* Warna abu-abu dari Bootstrap */
        }

        .dropdown-menu a:hover {
            background-color: #8a2be2 !important; /* Warna ungu saat dihover */
        }

        .action-menu a {
            color: #8a2be2 !important; /* Warna ungu */
        }

        .action-menu a:hover {
            background-color: white !important; /* Warna putih saat dihover */
            color: #8a2be2 !important; /* Warna ungu saat dihover */
        }
    </style>

    <!--Header Start-->
    <header>
        <section style="background-color: black;"
            id="topbar"
            class="mb-2 mb-lg-0 mb-sm-0 d-none d-lg-flex align-items-center pt-2 pb-2 text-white topbar-transparent">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-start">
                        <i class="bi bi-phone "></i> univent@universityeventmanagement.com <br>
                        <i class="bi bi-clock"></i> Mon-Fri: 09:00 AM - 05:00 PM
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="https://www.facebook.com/president.university/" class="me-4 text-reset">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/President_Univ" class="me-4 text-reset">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://president.ac.id/" class="me-4 text-reset">
                            <i class="bi bi-google"></i>
                        </a>
                        <a href="https://www.instagram.com/president_university/?hl=en" class="me-4 text-reset">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/school/president-university/" class="me-4 text-reset">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!--Navbar Start-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="../ems/img/log.png" alt="Logo" class="logo-img"> <!-- Ganti path/to/your/logo.png dengan path logo Anda -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="bi bi-list"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <?php
                            // Memeriksa peran pengguna dan mengarahkannya ke dashboard yang sesuai
                            if ($_SESSION['role'] == 'admin') {
                                echo '<a class="nav-link" aria-current="page" href="admin_dashboard.php">Home</a>';
                            } elseif ($_SESSION['role'] == 'guest') {
                                echo '<a class="nav-link" aria-current="page" href="guest_dashboard.php">Home</a>';
                            }
                            ?>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li> -->

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                About
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="about.php">Introduction</a></li>
                                <li><a class="dropdown-item" href="more.php">Get to Know More</a></li>
                            </ul>
                        </li>
                        <!-- Ganti link "Events" dengan "Calender" -->
                        <li class="nav-item">
                            <a class="nav-link" href="calender.php">Calendar</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Forum
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="organizations.php">Organizations</a></li>
                                <li><a class="dropdown-item" href="discussion.php">Discussion</a></li>
                            </ul>
                        </li>
                        <!-- Tambahkan tombol "Booking" dengan dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Booking
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <?php
                                    if ($_SESSION['role'] == 'admin') {
                                        echo '<a class="dropdown-item" href="booking_admin.php">Booking List</a>';
                                    } elseif ($_SESSION['role'] == 'guest') {
                                        echo '<a class="dropdown-item" href="booking_guest.php">Booking List</a>';
                                    }
                                    ?>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0 action-menu">
                        <li class="nav-item">
                            <a class="nav-link " href="update_profile.php">
                            <span class="bi bi-person"></span> Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="logout.php">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <!--Header End-->

    <!--Custom Css-->
    <link rel="stylesheet" href="./CSS/style.css">
    <!--End Custom Css-->
</head>

</html>
