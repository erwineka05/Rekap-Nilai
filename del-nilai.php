<?php
session_start();
$akses = @$_SESSION['status'];
if (!isset($_SESSION['status']) || $akses != true || $_SESSION['role'] != 'dosen') {
    header("location:login.php?pesan=belum_login");
}

require "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_induk = $_POST['nomor_induk'];
    $kode_matkul = $_POST['kode_matkul'];

    $delete_sql = "UPDATE nilai 
                   SET tugas = NULL, uts = NULL, uas = NULL, rata_rata = NULL
                   WHERE id_mahasiswa = '$nomor_induk' AND kode_matkul = '$kode_matkul'";

    if (mysqli_query($sambung, $delete_sql)) {
        header("Location: up-nilai.php?pesan=sukses-hapus");
        exit;
    } else {
        echo "Error: " . mysqli_error($sambung);
    }
}
?>
