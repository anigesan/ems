<?php
include('session.php');
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SESSION['role'] == 'admin') {
    // Tampilkan konten khusus admin
    echo "Selamat datang, Admin!";
    // Tambahkan konten admin di sini
} elseif ($_SESSION['role'] == 'guest') {
    // Tampilkan konten khusus guest
    echo "Selamat datang, Guest!";
    // Tambahkan konten guest di sini
} else {
    // Penanganan jika peran tidak teridentifikasi
    echo "Error: Peran tidak valid.";
}
?>

<!-- Headers Start -->
<?php
include 'index-layouts/header.php';
?>
<!-- Headers End -->

<link rel="stylesheet" href="css/style.css">
    <div id="carouselExampleCaptions" class="carousel slide mb-3" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-fluid w-100 h-100 overflow-hidden"
                    src="https://t3.ftcdn.net/jpg/02/98/47/38/360_F_298473896_Vsz21xTwMtroEeeGgU8pL2vwt3N65pfR.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <h3>Introducing</h3>
                    <h5>Gina</h5>
                    <p>uwuwuwuwuwuwu</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="img-fluid w-100 h-100 overflow-hidden"
                    src="https://t3.ftcdn.net/jpg/02/98/47/38/360_F_298473896_Vsz21xTwMtroEeeGgU8pL2vwt3N65pfR.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <h5>President University</h5>
                    <p>Where Tomorrow's Leaders Come Together</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="img-fluid w-100 h-100 overflow-hidden"
                    src="https://t3.ftcdn.net/jpg/02/98/47/38/360_F_298473896_Vsz21xTwMtroEeeGgU8pL2vwt3N65pfR.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <h5>President University</h5>
                    <p>Where Tomorrow's Leaders Come Together</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
<div class="partner">
  <div class="header-container5"></div>
  <div class="partner-container">
        <div class="logo-container">
            <img src="https://upload.wikimedia.org/wikipedia/en/a/ae/President_University_Logo.png" alt="Logo Perusahaan" id="logo" class="logo">
            <!-- <img src="https://upload.wikimedia.org/wikipedia/en/thumb/9/92/Chanel_logo_interlocking_cs.svg/1280px-Chanel_logo_interlocking_cs.svg.png" alt="Logo Channel" id="logo" class="logo" > -->
        </div>
    </div>
</div>
    </div>
    </div>

<div class="partner">
  <div class="header-container5"></div>
  <div class="partner-container">
    <div class="partner-icon">
      <div class="tooltip">
        <img src="https://upload.wikimedia.org/wikipedia/en/a/ae/President_University_Logo.png" alt="" width=50px height=50px >
        <span class="tooltiptext">SM Entertainment</span>
      </div>
      <div class="tooltip">
        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/9/92/Chanel_logo_interlocking_cs.svg/1280px-Chanel_logo_interlocking_cs.svg.png" alt="" width=50px height=50px >
        <span class="tooltiptext">Grand Hotel</span>
      </div>
      <div class="tooltip">
        <img src="https://upload.wikimedia.org/wikipedia/en/a/ae/President_University_Logo.png" alt="" width=50px height=50px >
        <span class="tooltiptext">Atlantic Hotel</span>
      </div>
      <div class="tooltip">
        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/9/92/Chanel_logo_interlocking_cs.svg/1280px-Chanel_logo_interlocking_cs.svg.png" alt="" width=50px height=50px >
        <span class="tooltiptext">Internazionale Hotel</span>
      </div>
      <div class="tooltip">
        <img src="https://upload.wikimedia.org/wikipedia/en/a/ae/President_University_Logo.png" alt="" width=50px height=50px >
        <span class="tooltiptext">Seventeen</span>
      </div>
      <div class="tooltip">
        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/9/92/Chanel_logo_interlocking_cs.svg/1280px-Chanel_logo_interlocking_cs.svg.png" alt="" width=50px height=50px >
        <span class="tooltiptext">University of Oxford</span>
      </div>
      <div class="tooltip">
        <img src="https://upload.wikimedia.org/wikipedia/en/a/ae/President_University_Logo.png" alt="" width=50px height=50px >
        <span class="tooltiptext">Exo Kokobop</span>
      </div>
      <div class="tooltip">
        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/9/92/Chanel_logo_interlocking_cs.svg/1280px-Chanel_logo_interlocking_cs.svg.png" alt="" width=50px height=50px >
        <span class="tooltiptext">Attack on Titan</span>
      </div>
      <div class="tooltip">
        <img src="https://upload.wikimedia.org/wikipedia/en/a/ae/President_University_Logo.png" alt="" width=50px height=50px >
        <span class="tooltiptext">Magna Hotel</span>
      </div>
      <div class="tooltip">
        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/9/92/Chanel_logo_interlocking_cs.svg/1280px-Chanel_logo_interlocking_cs.svg.png" alt="" width=50px height=50px >
        <span class="tooltiptext">Harry Potter</span>
      </div>
    </div>
  </div>
</div>
    

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about mt-5">
            <div class="container-fluid">
                <h2 class="h1-responsive font-weight-bold text-center my-2">About</h2>
                <!--Section description-->
                <p class="text-center w-responsive mx-auto mb-1">Do you have any questions? Please do not hesitate to
                    contact us directly. Our team will come back to you within
                    a matter of hours to help you.</p>
                <div class="row  pt-5 pb-5">

                    <div class="col-lg-5 align-items-stretch video-box"
                        style='background-image: url("https://lh3.googleusercontent.com/p/AF1QipN5KquAeBA-CgBvBJ75wPfLcDYgCdR5jhLl3NQ3=s1360-w1360-h1020");'>
                        <a href="https://www.youtube.com/watch?v=_3G-PYCVuKs" class="venobox play-btn mb-4"
                            data-vbtype="video" data-autoplay="true"></a>
                    </div>

                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch">

                        <div class="content">
                            <h3>President University  <strong> is a privately-owned academic institution</strong></h3>
                            <p>
                                situated in the Jababeka Industrial Area of Cikarang, West Java, Indonesia. It was founded in 2001 and has progressively established itself as one of the foremost universities in the country, 
                                offering an extensive range of undergraduate and postgraduate programs in diverse fields such as engineering, business, information technology, communication, and humanity.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End About Section -->

        <section>
            <div class="container course pb-5 pt-5">
                <h2 class="h1-responsive font-weight-bold text-center my-4">Courses</h2>
                <!--Section courses-->
                <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to
                    contact us directly. Our team will come back to you within
                    a matter of hours to help you.</p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card box">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="https://cdn.pixabay.com/photo/2016/09/08/04/12/programmer-1653351_960_720.png"
                                    class="img-fluid" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Information Technology</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href="#!" style="background: #DDF7E3" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card box">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="https://cdn.pixabay.com/photo/2017/09/25/11/55/cyberspace-2784907_960_720.jpg"
                                    class="img-fluid" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Electronic Engineering</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href="#!" style="background: #DDF7E3" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card box">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="https://cdn.pixabay.com/photo/2020/12/05/14/08/man-5806012_960_720.jpg"
                                    class="img-fluid" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Civil Engineering</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href="#!" style="background: #DDF7E3" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <h2 class="h1-responsive font-weight-bold text-center my-4">Our Gallery</h2>
                <!--Section description-->
                <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within a matter of hours to help you.</p>
                <!-- Gallery -->
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                        <img class="w-100 shadow-1-strong rounded mb-4" src="https://president.ac.id/filedata/public/publicfile/_MG_9380_edited-a3809.jpg" alt="President University Dormitory" />

                        <img class="w-100 shadow-1-strong rounded mb-4" src="https://lh3.googleusercontent.com/p/AF1QipNvdvAi_Mor4rhvS_rEE1iLeuYmpK4jjXHFcgWh=s1360-w1360-h1020" alt="Basketball Court" />
                    </div>

                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img class="w-100 shadow-1-strong rounded mb-4" src="https://president.ac.id/filedata/public/publicfile/IMG_9655-044bd.JPG" alt="President University Facility" />

                        <img class="w-100 shadow-1-strong rounded mb-4" src="https://president.ac.id/filedata/public/publicfile/JCC-31d36.jpg" alt="President University Facility" />
                    </div>

                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img class="w-100 shadow-1-strong rounded mb-4" src="https://lh3.googleusercontent.com/p/AF1QipPktOBuhm3II5B9jCbebEE7ddTYmgpjxy8Fp_Kv=s1360-w1360-h1020" alt="President University Facility" />

                        <img class="w-100 shadow-1-strong rounded mb-4" src="https://lh3.googleusercontent.com/p/AF1QipNM5-NSBF-IRD1EWxqQ3uYIdJiYwwVVl8Xg0XLW=s1360-w1360-h1020" alt="President University Facility" />
                    </div>
                </div>
                <!-- Gallery -->
            </div>
        </section>


        <section>
            <div class="container mb-5">
                <!--Section: Contact v.2-->
                <section class="mb-4">

                    <!--Section heading-->
                    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
                    <!--Section description-->
                    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate
                        to contact us directly. Our team will come back to you within
                        a matter of hours to help you.</p>

                    <div class="row">

                        <!--Grid column-->
                        <div class="col-md-6 mb-md-0 mb-5">
                            <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                                <!--Grid row-->
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="text" id="name" name="name" class="form-control">
                                            <label for="name" class="">Your name</label>
                                        </div>
                                    </div>
                                    <!--Grid column-->

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="text" id="email" name="email" class="form-control">
                                            <label for="email" class="">Your email</label>
                                        </div>
                                    </div>
                                    <!--Grid column-->

                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="md-form mb-0">
                                            <input type="text" id="subject" name="subject" class="form-control">
                                            <label for="subject" class="">Subject</label>
                                        </div>
                                    </div>
                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-12">

                                        <div class="md-form">
                                            <textarea type="text" id="message" name="message" rows="2"
                                                class="form-control md-textarea"></textarea>
                                            <label for="message">Your message</label>
                                        </div>

                                    </div>
                                </div>
                                <!--Grid row-->

                            </form>

                            <div class="text-center text-md-left">
                                <a style="background: #C7E8CA;" class="btn"
                                    onclick="document.getElementById('contact-form').submit();">Send</a>
                            </div>
                            <div class="status"></div>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-md-6 text-center">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.838153284793!2d107.16797137583764!3d-6.284994961520615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6984caf54df305%3A0xb7156354ad963e4d!2sPresident%20University%2C%20Jababeka%20Education%20Park%2C%20Cikarang%2C%20Bekasi!5e0!3m2!1sen!2sid!4v1682507856075!5m2!1sen!2sid"
                                 width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <!--Grid column-->

                    </div>

                </section>
                <!--Section: Contact v.2-->
            </div>
        </section>

<?php
include 'index-layouts/footer.php';
?>

       