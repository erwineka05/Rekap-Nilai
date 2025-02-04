<?php
session_start();
require 'config.php';

$nomor_induk = $_POST['nomor_induk'];
$password = $_POST['password'];

if (!empty($nomor_induk) && !empty($password)) {
    $query = mysqli_query($sambung, "SELECT * FROM users WHERE nomor_induk= '$nomor_induk' AND password='$password'");
    $result = mysqli_num_rows($query);

    $data = mysqli_fetch_array($query);
    if ($data) {
        $_SESSION['status'] = true;
        $_SESSION['nomor_induk'] = $nomor_induk;
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        if ($data['role'] == 'admin') {
            header("Location: home.php");
        } elseif ($data['role'] == 'dosen') {
            header("Location: hm-dosen.php");
        } elseif ($data['role'] == 'siswa') {
            header("Location: home.php");
        }
    } else {
        $_SESSION["error"] = "Nomor Induk atau Password anda salah";
        header("location:login.php?pesan=gagal");
    }
} else {
    $_SESSION["error"] = "Nomor Induk atau Password tidak boleh kosong";
    header("location:login.php?pesan=error");
}
?>