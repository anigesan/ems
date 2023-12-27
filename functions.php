<?php

// Include file konfigurasi database

// Fungsi untuk mengambil data acara dari database
function getEventsFromDatabase() {
    global $db;

    // Lakukan query ke database
    $query = "SELECT * FROM events";
    $result = mysqli_query($db, $query);

    // Inisialisasi array untuk menyimpan data acara
    $events = array();

    // Loop melalui hasil query dan tambahkan ke dalam array $events
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }

    // Mengembalikan array data acara
    return $events;
}

?>
