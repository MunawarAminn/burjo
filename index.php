<?php
session_start();
require_once "function.php";

if (!isset($_SESSION["akun-admin"]) && !isset($_SESSION["akun-user"])) {
    header("Location: login.php");
    exit;
}

// Handling sortir
if (isset($_GET["sort"])) {
    $sortir = $_GET["sort"];
    switch ($sortir) {
        case "minuman":
            $menu = ambil_data("SELECT * FROM menu WHERE kategori = 'minuman' ORDER BY kode_menu DESC");
            break;
        case "makanan":
            $menu = ambil_data("SELECT * FROM menu WHERE kategori = 'makanan' ORDER BY kode_menu DESC");
            break;
        case "snack":
            $menu = ambil_data("SELECT * FROM menu WHERE kategori = 'snack' ORDER BY kode_menu DESC");
            break;
        default:
            $menu = ambil_data("SELECT * FROM menu ORDER BY kode_menu DESC");
            break;
    }
} else if (isset($_GET["transaksi"])) {
    $menu = ambil_data("SELECT * FROM transaksi");
} else if (isset($_GET["pesanan"])) {
    $menu = ambil_data("SELECT p.kode_pesanan, tk.nama_pelanggan, p.kode_menu, p.qty
                        FROM pesanan AS p
                        JOIN transaksi AS tk ON (tk.kode_pesanan = p.kode_pesanan)
                      ");
} else if (isset($_GET["key-search"])) {
    $key_search = $_GET["key-search"];
    $menu = ambil_data("SELECT * FROM menu WHERE nama LIKE '%$key_search%' OR
                                            harga LIKE '%$key_search%' OR
                                            kategori LIKE '%$key_search%' OR
                                            status LIKE '%$key_search%'
                                            ORDER BY kode_menu DESC
    ");
} else {
    $menu = ambil_data("SELECT * FROM menu ORDER BY kode_menu DESC");
}

if (isset($_POST["pesan"])) {
    $pesanan = tambah_data_pesanan();
    echo $pesanan > 0
    ? "<script>
        alert('Pesanan Berhasil Dikirim!');
    </script>"
    : "<script>
        alert('Pesanan Gagal Dikirim!');
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
    <link rel="stylesheet" href="./src/css/bootstrap-icons-1.8.3/bootstrap-icons.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <title>Burjo HDHT 4</title>
    <style>
        .menu-icon {
            font-size: 1.2em;
            margin-right: 5px;
            vertical-align: middle;
        }

        .menu-text {
            font-size: 0.8em;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #333;
            display: inline-block;
            padding: 6px 10px;
            border-radius: 5px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid position-fixed top-0 bg-dark p-2 d-flex justify-content-between" style="z-index: 2;">
        <div class="text-white h3 d-flex align-items-center">
            <span id="menu-list" role="button"><i class="bi bi-list"></i></span>
            <span class="mx-2">BURJO HDHT 4</span>
        </div>
        <a class="btn btn-danger fw-bold" href="logout.php" onclick="return confirm('Ingin Logout?')"><i class="bi bi-box-arrow-right"></i></a>
    </div>

    <div id="dropdown-menu" class="container-fluid position-fixed float-start bg-dark text-white w-auto vh-100" style="display: none; z-index: 1; top: 50px;">
        <ul>
            <br>
            <li><a class="text-decoration-none p-2 h5 text-light" href="index.php"><i class="bi bi-list-ul menu-icon"></i><span class="menu-text">Menu</span></a></li><br>
            <?php if (isset($_SESSION["akun-admin"])) { ?>
            <li><a class="text-decoration-none p-2 h5 text-light" href="index.php?pesanan"><i class="bi bi-cart4 menu-icon"></i><span class="menu-text">Pesanan</span></a></li><br>
            <li><a class="text-decoration-none p-2 h5 text-light" href="index.php?transaksi"><i class="bi bi-currency-dollar menu-icon"></i><span class="menu-text">Transaksi</span></a></li>
            <?php } ?>
        </ul>
    </div>

    <div class="container" style="z-index: -1; margin-top: 60px;">
        <?php if (!isset($_GET["pesanan"]) && !isset($_GET["transaksi"])) { ?>
        <div class="d-flex flex-wrap justify-content-between">
            <nav class="navbar navbar-light">
                <form action="index.php" method="GET" class="form-inline d-flex">
                    <input class="form-control mx-sm-2" type="search" autocomplete="off" name="key-search" placeholder="Cari..">
                    <button class="btn btn-success mx-2 menu-category" type="submit">Search</button>
                </form>
            </nav>
            <?php if (isset($_SESSION["akun-admin"])) { ?>
                <nav class="navbar navbar-light">
                    <div class="btn-group" role="group" aria-label="Sortir Menu">
                        <a class="btn btn-success fw-bold mx-2 menu-category" href="index.php?sort=minuman">Minuman</a>
                        <a class="btn btn-success fw-bold mx-2 menu-category" href="index.php?sort=makanan">Makanan</a>
                        <a class="btn btn-success fw-bold mx-2 menu-category" href="index.php?sort=snack">Snack</a>
                    </div>
                </nav>
            <?php } ?>
        </div>
        <?php } ?>

        <?php
        if (isset($_GET["pesanan"])) include "halaman/pesanan.php";
        else if (isset($_GET["transaksi"])) include "halaman/transaksi.php";
        else include "halaman/beranda.php";
        ?>
    </div>

    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <script src="src/js/beranda.js"></script>
</body>
</html>
