<?php
include('session.php');

// Headers Start
include 'index-layouts/header.php';

// Include file konfigurasi database dan fungsi
include('functions.php');

// Jika user adalah admin atau guest
if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'guest') {

    // Query untuk mendapatkan daftar semua acara yang bukan status 'Dibatalkan'
    $query = "SELECT * FROM events WHERE status != 'Dibatalkan'";

    // Jika user adalah admin, batasi acara yang hanya dibuat oleh admin yang sedang login
    if ($_SESSION['role'] == 'admin') {
        $admin_id = $_SESSION['user_id'];
        $query .= " AND admin_id = $admin_id";
    }

    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Error: " . mysqli_error($db));
    }

    // Ambil data acara dari database
    $events = getEventsFromDatabase();

    // Membuat objek untuk menyimpan event dalam format yang diinginkan oleh FullCalendar
    $calendarEvents = array();

    // Loop melalui setiap acara dan tambahkan ke dalam array $calendarEvents
    foreach ($events as $event) {
        // Hanya tambahkan acara dengan status bukan 'Dibatalkan' ke dalam kalender
        if ($event['status'] != 'Dibatalkan') {
            $calendarEvents[] = array(
                'id' => $event['id'],
                'title' => $event['nama_acara'],
                'description' => $event['deskripsi'],
                'start' => $event['tanggal'],
                'end' => $event['tanggal'],
            );
        }
    }

    // Konversi array $calendarEvents ke format JSON
    $calendarEventsJSON = json_encode($calendarEvents);
    ?>

    <!-- Headers End -->

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Event Calendar</title>

        <!-- FullCalendar CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- FullCalendar JS dan Moment JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

        <!-- FullCalendar Script -->
        <script>
    $(document).ready(function () {
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            events: <?php echo json_encode($calendarEvents); ?>,
            eventRender: function (event, element) {
                element.attr('href', 'detail_event.php?id=' + event.id); // Menambahkan atribut href ke setiap elemen event
                element.attr('data-toggle', 'tooltip'); // Menambahkan tooltip
                element.attr('title', event.title); // Menetapkan judul tooltip
            },
            eventMouseover: function (event, jsEvent, view) {
                $(this).css('background-color', 'grey'); // Mengganti warna saat dihover
            },
            eventMouseout: function (event, jsEvent, view) {
                $(this).css('background-color', ''); // Mengembalikan warna normal saat mouse keluar
            }
        });

        // Menambahkan tooltip
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    });
</script>
    </head>

    <body>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

    </body>

    </html>

    <?php
} else {
    header("Location: haha.php");
    exit();
}

// Headers End
include 'index-layouts/footer.php';
?>
