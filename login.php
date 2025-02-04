<?php
session_start();
$akses = @$_SESSION['status'];
if (isset($_SESSION['status']) && $akses==true){
    header("location:home.php");
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #2E3B4E;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            display: flex;
            width: 80%;
            height: 90%;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .login-container img {
            width: 45%;
            height: 100%;
            border-radius: 8px 0 0 8px;
            object-fit: cover;
        }
        .login-form {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .login-form button {
            padding: 10px;
            background-color: #FF4B4B;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-form a {
            color: #007BFF;
            text-decoration: none;
            font-size: 0.7rem;
        }
        .login-form .forgot,
        .login-form .register {
            text-align: left;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="anime.png">
        <div class="login-form">
            <h2>LOGIN REKAPITULASI</h2>
            <form action="ctrl-login.php" method="POST">
                <label>NIM/NIP</label>
                <input type="text" name="nomor_induk" placeholder="Masukan Nomor Induk">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukan Password">
                <button type="submit" name="login">Login</button>
            </form>
            <div class="forgot">
                <a href="#"><U>Lupa password?</U></a>
            </div>
            <div class="register">
                <a href="register.php">Belum punya akun? <u>Register here</u></a>
            </div>

            <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "gagal") {
                    echo "Login gagal! Nomor Induk atau Password salah";
                } else if ($_GET['pesan'] == "logout") {
                    echo "Anda telah berhasil logout";
                } else if ($_GET['pesan'] == "belum_login") {
                    echo "Anda harus login untuk mengakses halaman admin";
                } else if ($_GET['pesan'] == "error") {
                    echo "Nomor Induk atau Password tidak boleh kosong";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>