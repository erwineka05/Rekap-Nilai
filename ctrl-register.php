<?php
include 'config.php';

if(isset($_POST['register'])){
    $nama = $_POST['nama'];
    $nomor_induk = $_POST['nomor_induk'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if(empty($nama) || empty($nomor_induk) || empty($password) || empty($email)){
        header('location:register.php?pesan=kosong');
        exit;
    }
    $query = mysqli_query($sambung, "SELECT * FROM users WHERE nomor_induk='$nomor_induk'");
    if(mysqli_num_rows($query) > 0){
        header('location:register.php?pesan=gagal');
    } else {
        $insert = mysqli_query($sambung, "INSERT INTO users (nama, nomor_induk, password, email) VALUES ('$nama', '$nomor_induk', '$password', '$email')");
        if($insert){
            header('location:register.php?pesan=sukses');
        } else {
            echo "Terjadi kesalahan saat mendaftar";
        }
    }
}
?>