<?php 
$errormessage = @$_GET["error"];

session_start();

$akses = @$_SESSION['akses'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="image">
                <img src="anime.png">
            </div>
            <div class="form-container">
                <h2>Login Form</h2>
                <form action="ctrl-login.php" method="POST">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukan Nama">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukan Password">
                    <a href = "home.php">
                        <button type="submit">Login</button>
                </form>
                <div class="options">
                    <a href="#">Lupa password?</a>
                    <a href="form.register.php">Don't have an account? <u>Register</u></a>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){
            echo "Login gagal! username dan password salah";
        }else if($_GET['pesan'] == "logout"){
            echo "Anda telah berhasil logout";
        }else if($_GET['pesan'] == "belum_login"){
            echo "Anda harus login untuk mengakses halaman admin";
        }
    }
    ?>
</body>
</html>