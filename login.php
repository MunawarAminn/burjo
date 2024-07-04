<?php
session_start();
require_once "function.php";

// Inisialisasi variabel $login
$login = null;

// Memeriksa apakah tombol login ditekan
if (isset($_POST["login"])) {
    $login = login_akun();
}

// Memeriksa apakah tombol register ditekan
else if (isset($_POST["register"])) {
    $register = register_akun();
    echo $register > 0
        ? "<script>
            alert('Berhasil Registrasi!');
            location.href = 'login.php';
        </script>"
        : "<script>
            alert('Gagal Registrasi!');
            location.href = 'login.php';
        </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./src/css/style.css"> <!-- Custom CSS -->
    <title>Login</title>
</head>
<body class="bg-light">
    <div class="container">
        <div id="judul-form" class="text-center h1 mt-5">BURJO</div><br>
        <div class="mx-auto rounded p-5" id="login-box">
            <div class="d-flex justify-content-between mb-4">
                <button id="tab-login" class="btn btn-primary fw-bold active-tab" style="width: 190px;">LOGIN</button>
                <button class="btn btn-outline-primary fw-bold" style="width: 190px;">REGISTER</button>
            </div>
            <?php
            if (isset($_POST["login"])) {
                // Cek apakah $login tidak null dan hasil login gagal
                if ($login !== null && !$login) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        * username/password salah
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
            <?php }
            } ?>
            <form id="form" action="login.php" method="POST">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                    <span class="input-group-text" id="toggle-password">
                        <i class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
                    </span>
                </div>
                <button class="btn btn-primary w-100 btn-lg" name="login">Login</button>
            </form>
        </div>
    </div>
    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <script src="./src/js/login.js"></script>
</body>
</html>
