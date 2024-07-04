<?php 
require_once "../function.php";

$kode = $_GET["kode_pesanan"];
$menu = ambil_data("SELECT DISTINCT * FROM pesanan 
                    JOIN transaksi ON (pesanan.kode_pesanan = transaksi.kode_pesanan) 
                    JOIN menu ON (menu.kode_menu = pesanan.kode_menu) 
                    WHERE transaksi.kode_pesanan = '$kode'
");

// Check if $menu has valid data
if (!$menu || empty($menu)) {
    // Handle case where $menu is empty or not retrieved
    echo "<p>Data pesanan tidak ditemukan.</p>";
} else {
    // Calculate total
    $total_semuanya = 0;
    foreach ($menu as $m) {
        $total_semuanya += $m["harga"] * $m["qty"];
    }

    // Set bayar and kembali
    $bayar = isset($_GET["pembayaran"]) ? (int)$_GET["pembayaran"] : 0;
    $kembali = $bayar - $total_semuanya;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $menu[0]["nama_pelanggan"]; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .data-pelanggan {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .data-pelanggan th, .data-pelanggan td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .daftar-pesanan {
            width: 100%;
            border-collapse: collapse;
        }

        .daftar-pesanan th, .daftar-pesanan td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .pembayaran {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .pembayaran th, .pembayaran td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            background-color: white; /* Warna latar belakang putih */
        }

        .pembayaran th {
            width: 50%;
            background-color: #f0f0f0;
        }

        .pembayaran .total {
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bukti Pembayaran</h1>
        <table class="data-pelanggan">
            <tr>
                <th>Atas Nama</th>
                <td><?= $menu[0]["nama_pelanggan"]; ?></td>
            </tr>
            <tr>
                <th>Waktu</th>
                <td><?= $menu[0]["waktu"]; ?></td>
            </tr>
        </table>
        <br>
        <table class="daftar-pesanan">
            <thead>
                <tr>
                    <th>Daftar Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menu as $m) { ?>
                    <tr>
                        <td><?= $m["nama"]; ?></td>
                        <td>Rp.<?= $m["harga"]; ?></td>
                        <td><?= $m["qty"]; ?></td>
                        <td>Rp.<?= $m["harga"] * $m["qty"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <table class="pembayaran">
            <tbody>
                <tr>
                    <th>Total Semuanya</th>
                    <td class="total">Rp.<?= $total_semuanya; ?></td>
                </tr>
                <tr>
                    <th>Bayar</th>
                    <td>Rp.<?= $bayar; ?></td>
                </tr>
                <tr>
                    <th>Kembali</th>
                    <td>Rp.<?= $kembali; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php 
}
?>
