<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    $query = "DELETE FROM absensi WHERE id = '$id'";
    $eksekusi = mysqli_query($koneksi, $query);

    if ($eksekusi) {
        header("Location: dashboard.php?pesan=hapussukses");
        exit;
    } else {
        die("Gagal menghapus data: " . mysqli_error($koneksi));
    }
} else {
    header("Location: dashboard.php?pesan=idkosong");
    exit;
}
?>
