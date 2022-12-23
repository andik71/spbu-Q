<?php
$conn = new mysqli("localhost", "root", "", "db_spbu");

if (!$conn) {
    die("Koneksi Tidak Berhasil: " . mysqli_connect_error());
}
