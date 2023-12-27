<?php
// Include file konfigurasi database dan fungsi
include('config.php');
include('functions.php');

// Ambil data acara dari database
$events = getEventsFromDatabase();

// Membuat objek untuk menyimpan event dalam format yang diinginkan oleh FullCalendar
$calendarEvents = array();

// Loop melalui setiap acara dan tambahkan ke dalam array $calendarEvents
foreach ($events as $event) {
    $calendarEvents[] = array(
        'id' => $event['id'],
        'title' => $event['nama_acara'],
        'description' => $event['deskripsi'],
        'start' => $event['tanggal'], // Tanggal mulai acara
        'end' => $event['tanggal'],   // Tanggal selesai acara (bisa disesuaikan)
        'color' => $event['warna'],   // Warna acara sesuai dengan user yang membuat
    );
}

// Konversi array $calendarEvents ke format JSON
echo json_encode($calendarEvents);
?>
