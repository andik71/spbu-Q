<?php
include 'koneksi.php';
session_start();

$id = $_GET['id'];
$queryResult = $conn->query("DELETE FROM spbu WHERE id='$id'");

if ($queryResult) {
    $_SESSION['pesan'] = 'Data spbu berhasil dihapus';
    echo "<script>
    window.location.href = 'spbu.php';
    </script>";
}
