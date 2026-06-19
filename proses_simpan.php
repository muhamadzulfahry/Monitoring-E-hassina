<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_guru      = mysqli_real_escape_string($koneksi, $_POST['nama_guru']);
    $mata_pelajaran = mysqli_real_escape_string($koneksi, $_POST['mata_pelajaran']);
    $jam_kerja      = mysqli_real_escape_string($koneksi, $_POST['jam_kerja']);
    $tanggal        = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $tanda_tangan   = isset($_POST['tanda_tangan']) ? mysqli_real_escape_string($koneksi, $_POST['tanda_tangan']) : '';

    $file_bukti = "";
    if (isset($_FILES['file_bukti']) && $_FILES['file_bukti']['error'] == 0) {
        $nama_file = time() . '_' . $_FILES['file_bukti']['name'];
        $tmp_file  = $_FILES['file_bukti']['tmp_name'];
        $folder    = "uploads/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (move_uploaded_file($tmp_file, $folder . $nama_file)) {
            $file_bukti = $nama_file;
        }
    }

    $query = "INSERT INTO absensi (nama_guru, mata_pelajaran, jam_kerja, tanggal, file_bukti, tanda_tangan) 
              VALUES ('$nama_guru', '$mata_pelajaran', '$jam_kerja', '$tanggal', '$file_bukti', '$tanda_tangan')";
    
    $eksekusi = mysqli_query($koneksi, $query);

    if ($eksekusi) {
        header("Location: dashboard.php?pesan=simpansukses");
        exit;
    } else {
        die("Gagal menyimpan data ke database: " . mysqli_error($koneksi));
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>
