<?php
session_start();
$akses = @$_SESSION['status'];
if (!isset($_SESSION['status']) || $akses != true || $_SESSION['role'] != 'siswa') {
    header("location:login.php?pesan=belum_login");
}

require "config.php";
$nomor_induk = $_SESSION['nomor_induk'];
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
            background-color: blue;
            border: none;
            color: white;
            cursor: pointer;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .sidebar button:hover {
            background-color: #37005c;
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

        .table-container {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 10px;
            overflow-x: auto;
            overflow-y: auto;
            max-height: 400px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #dddddd;
        }

        th {
            background-color: orange;
            color: black;
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
                <a href="home.php">Home</a>
                <a href="nilai.php">Nilai</a>
            </nav>
        </div>

        <div class="main-content">
            <div class="header">
                <h1><u>SELAMAT DATANG <?PHP echo $_SESSION['nama']; ?></u></h1>
            </div>
            <h3><u>Info Nilai <?PHP echo $_SESSION['nama']; ?></u></h3>
            <table border=1 class="table-container">
                <thead>
                    <tr>
                        <th>sks</th>
                        <th>mata kuliah</th>
                        <th>tugas</th>
                        <th>uts</th>
                        <th>uas</th>
                        <th>rata-rata</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT mata_kuliah.nama_matkul, mata_kuliah.sks, nilai.tugas, nilai.uts, nilai.uas, 
                    (COALESCE(nilai.tugas, 0) + COALESCE(nilai.uts, 0) + COALESCE(nilai.uas, 0)) / 3 AS rata_rata
                    FROM mata_kuliah JOIN nilai
                    ON mata_kuliah.kode_matkul = nilai.kode_matkul
                    JOIN users ON nilai.id_mahasiswa = users.nomor_induk
                    WHERE nomor_induk = '$nomor_induk' AND role = 'siswa'
                    GROUP BY mata_kuliah.nama_matkul, mata_kuliah.sks, nilai.tugas, nilai.uts, nilai.uas;";
                    
                    $query = mysqli_query($sambung, $sql);
                    while ($datauser = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($datauser["sks"]) . "</td>";
                        echo "<td>" . htmlspecialchars($datauser["nama_matkul"]) . "</td>";
                        echo "<td>" . htmlspecialchars($datauser["tugas"]) . "</td>";
                        echo "<td>" . htmlspecialchars($datauser["uts"]) . "</td>";
                        echo "<td>" . htmlspecialchars($datauser["uas"]) . "</td>";
                        echo "<td>" . number_format($datauser["rata_rata"],2) . "</td>";
                        echo "</tr>";
                    } 

                    if (mysqli_num_rows($query) == 0) {
                        echo "<tr><td colspan='6'>Data tidak ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>