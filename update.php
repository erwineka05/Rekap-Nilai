<?php
session_start();
$akses = @$_SESSION['status'];
if (!isset($_SESSION['status']) || $akses != true || $_SESSION['role'] != 'dosen') {
    header("location:login.php?pesan=belum_login");
}

require "config.php";

$nomor_induk = $_GET['nomor_induk'];
$kode_matkul = $_GET['kode_matkul'];

$sql = "SELECT * FROM nilai WHERE id_mahasiswa = '$nomor_induk' AND kode_matkul = '$kode_matkul'";
$query = mysqli_query($sambung, $sql);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_tugas = $_POST['tugas'];
    $new_uts = $_POST['uts'];
    $new_uas = $_POST['uas'];
    $new_rata_rata = ($new_tugas+$new_uts+$new_uas)/3;

    $update_sql = "UPDATE nilai SET tugas = '$new_tugas', uts = '$new_uts', uas = '$new_uas', 
    rata_rata = '$new_rata_rata' WHERE id_mahasiswa = '$nomor_induk' AND kode_matkul = '$kode_matkul'";
    if (mysqli_query($sambung, $update_sql)) {
        header("Location: up-nilai.php?pesan=sukses-update");
        exit;
    } else {
        echo "Error: " . mysqli_error($sambung);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Nilai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #dadada;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: orange;
            padding: 50px;
            max-width: 500px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: bold;
            color: #555555;
            margin-bottom: 8px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 16px;
            color: #333333;
        }

        button {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: aqua;
        }

        .back-link {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: blue;
            font-size: 14px;
        }

        .back-link:hover {
            color: aqua;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Update Nilai untuk NIM <?php echo htmlspecialchars($data['nama_matkul']= $nomor_induk); ?></h2>
        <form action="" method="POST">
            <label>Nilai Tugas:</label>
            <input type="number" name="tugas" value="<?php echo htmlspecialchars($data['tugas']); ?>" required>
            <label>Nilai UTS:</label>
            <input type="number" name="uts" value="<?php echo htmlspecialchars($data['uts']); ?>" required>
            <label>Nilai UAS:</label>
            <input type="number" name="uas" value="<?php echo htmlspecialchars($data['uas']); ?>" required>
            <button type="submit">Update</button>
        </form>
        <a href="up-nilai.php" class="back-link">Kembali</a>
    </div>
</body>

</html>