<?php
include 'koneksi.php';
session_start();

$id = $_GET['id'];
$queryResult = $conn->query("DELETE FROM user WHERE id='$id'");

if ($queryResult) {
    $_SESSION['pesan'] = 'Data user berhasil dihapus';
    echo "<script>
    window.location.href = 'user.php';
    </script>";
}
