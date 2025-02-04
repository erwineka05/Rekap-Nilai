<?php
session_start();
require "config.php"; 

$akses = @$_SESSION['status'];
if (!isset($_SESSION['status']) || $akses != true || $_SESSION['role'] != 'dosen') {
    header("location:login.php?pesan=belum_login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_induk = mysqli_real_escape_string($sambung, $_POST['nomor_induk']);
    $kode_matkul = mysqli_real_escape_string($sambung, $_POST['mata-kuliah']);
    $tugas = mysqli_real_escape_string($sambung, $_POST['tugas']);
    $uts = mysqli_real_escape_string($sambung, $_POST['uts']);
    $uas = mysqli_real_escape_string($sambung, $_POST['uas']);

    $rata_rata = ($tugas + $uts + $uas) / 3;

    $insert_sql = "INSERT INTO nilai (id_mahasiswa, kode_matkul, tugas, uts, uas, rata_rata)
                   VALUES ('$nomor_induk', '$kode_matkul', '$tugas', '$uts', '$uas', '$rata_rata')";

    if (mysqli_query($sambung, $insert_sql)) {
        header("Location:up-nilai.php?pesan=sukses-tambah");
        exit;
    } else {
        echo "Error: " . mysqli_error($sambung);
    }
}
?>
