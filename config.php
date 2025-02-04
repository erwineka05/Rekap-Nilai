<?php
$server = "localhost";
$nomor_induk = "root";
$password = "";
$database = "uts";

$sambung = mysqli_connect($server, $nomor_induk, $password, $database);
if(!$sambung){
    die("Ada masalah koneksi ke database: ". mysqli_connect_error());
}
?>
