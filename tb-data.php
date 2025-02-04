<?php
session_start();
$akses = @$_SESSION['status'];
if (!isset($_SESSION['status']) || $akses != true || $_SESSION['role'] != 'dosen') {
    header("location:login.php?pesan=belum_login");
}

require "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rekap-nilai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        header {
            width: 100%;
            height: 9%;
            background-color: #1b0050;
            color: white;
            padding: 15px 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 1.5em;
            display: flex;
            align-items: center;
        }

        header h1 img {
            border-radius: 50%;
            margin-right: 10px;
            width: 40px;
            height: 40px;
        }

        header button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 10px;
        }

        .container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        .sidebar {
            width: 17%;
            background-color: #37005c;
            color: white;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: ;
            overflow-y: auto;
        }

        .sidebar img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .sidebar p {
            text-align: center;
            margin: 5px 0;
            margin-bottom: 20px;
        }

        .sidebar button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #1111a8;
            border: none;
            color: white;
            cursor: pointer;
            margin-top: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .sidebar button:hover {
            background-color: #5c6a91;
        }

        .sidebar hr {
            margin: 10px 0;
            border: 1px solid #6573a4;
            margin-bottom: 10px;
        }

        .sidebar nav a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: white;
            margin: 5px 0;
            background-color: orange;
            text-align: center;
            border-radius: 5px;
        }

        .sidebar nav a:hover {
            background-color: #5c6a91;
        }

        .main-content {
            width: 80%;
            padding: 20px;
            overflow-y: auto;
        }

        .main-content .header h1 {
            margin: 0;
            text-align: center;
        }

        .form-container {
            background-color: #e0e0e0;
            padding: 20px;
            border-radius: 10px;
            width: 60%;
            margin: 0 auto;
        }

        .form-container label {
            display: block;
            width: 100%;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        .form-container input,
        .form-container select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container .form-actions {
            display: flex;
            justify-content: space-between;
        }

        .form-container .form-actions button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-container .form-actions .submit-btn {
            background-color: green;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <h1>
            <img src="git.logo.png" alt="Logo"> REKAPITULASI
        </h1>
        <a href="logout.php"><button>LOGOUT</button></a>
    </header>

    <div class="container">
        <div class="sidebar">
            <div class="profile">
                <img src="anime.png" alt="Profile Picture">
                <h2><?PHP echo $_SESSION['nama']; ?></h2>
                <p><?PHP echo $_SESSION['nomor_induk']; ?></p>
                <button>EDIT INFO</button>
            </div>
            <hr>
            <nav>
                <a href="hm-dosen.php">Home</a>
                <a href="up-nilai.php">Nilai</a>
                <a href="tb-data.php">Tambah Data</a>
            </nav>
        </div>

        <div class="main-content">
            <div class="header">
                <h1><u>SELAMAT DATANG <?PHP echo $_SESSION['nama']; ?></u></h1>
            </div>
            <h3><u>Tambah Data Nilai Mahasiswa</u></h3>
            <div class="main-content">
                <div class="form-container">
                    <form action="ctrl-tambah.php" method="POST">
                        <label for="nim">NIM</label>
                        <input type="text" id="nomor_induk" name="nomor_induk" placeholder="Masukan NIM Mahasiswa">

                        <label for="mata-kuliah">Mata Kuliah</label>
                        <select id="mata-kuliah" name="mata-kuliah" placeholder="Pilih Mata Kuliah">
                            <option value="mk1">Bahasa Jepang</option>
                            <option value="mk2">Backend Development</option>
                            <option value="mk3">Animasi</option>
                            <option value="mk4">Bahasa Inggris</option>
                        </select>

                        <label for="tugas">Tugas</label>
                        <input type="text" name="tugas" placeholder="Masukan Total Nilai Tugas">

                        <label for="uts">UTS</label>
                        <input type="text" name="uts" placeholder="Masukan Nilai UTS">

                        <label for="uas">UAS</label>
                        <input type="text" name="uas" placeholder="Masukan Nilai UAS">

                        <div class="form-actions">
                            <button type="submit" class="submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>