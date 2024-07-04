<?php
$koneksi = mysqli_connect("localhost", "root", "", "burjo");

function register_akun()
{
    global $koneksi;

    $username = htmlspecialchars($_POST["username"]);
    $password = md5(htmlspecialchars($_POST["password"]));
    $email = htmlspecialchars($_POST["email"]);

    $cek_username = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `user` WHERE username = '$username'"));

    if ($cek_username != null) {
        echo "<script>
            alert('Username sudah ada!');
        </script>";
        return -1;
    }

    mysqli_query($koneksi, "INSERT INTO `user` (`username`, `password`, `email`)
                            VALUES ('$username', '$password', '$email')
    ");

    return mysqli_affected_rows($koneksi);
}

function login_akun()
{
    global $koneksi;

    $username = htmlspecialchars($_POST["username"]);
    $password = md5(htmlspecialchars($_POST["password"]));

    $cek_akun_admin = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `admin` 
                                                           WHERE username = '$username' AND 
                                                                `password` = '$password'
    "));
    $cek_akun_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `user` 
                                                           WHERE username = '$username' AND 
                                                                `password` = '$password'
    "));

    if ($cek_akun_admin == null && $cek_akun_user == null) return false;

    if ($cek_akun_user != null) {
        $_SESSION["akun-user"] = [
            "username" => $username,
            "password" => $password
        ];
    }

    if ($cek_akun_admin != null) {
        $_SESSION["akun-admin"] = [
            "username" => $username,
            "password" => $password
        ];
    }

    header("Location: index.php");
    exit;
}

function ambil_data($query)
{
    global $koneksi;

    $db = [];
    $sql_query = mysqli_query($koneksi, $query);

    while ($q = mysqli_fetch_assoc($sql_query)) {
        array_push($db, $q);
    }

    return $db;
}

function tambah_data_menu()
{
    global $koneksi;

    $nama = htmlspecialchars($_POST["nama"]);
    $harga = (int) htmlspecialchars($_POST["harga"]);
    $gambar = htmlspecialchars($_FILES["gambar"]["name"]);
    $kategori = htmlspecialchars($_POST["kategori"]);
    $status = htmlspecialchars($_POST["status"]);

    $kode_menu = "MN" . ambil_data("SELECT MAX(SUBSTR(kode_menu, 3)) AS kode FROM menu")[0]["kode"] + 1;

    $id_menu = ambil_data("SELECT MAX(SUBSTR(kode_menu, 3)) AS kode FROM menu")[0]["kode"] + 1;

    mysqli_query($koneksi, "INSERT INTO menu
                            VALUES ($id_menu, '$kode_menu', '$nama', $harga, '$nama_gambar', '$kategori', '$status')
    ");

    return mysqli_affected_rows($koneksi);
}

function edit_data_menu()
{
    global $koneksi;

    $id_menu = $_POST["id_menu"];
    $nama = htmlspecialchars($_POST["nama"]);
    $harga = (int) htmlspecialchars($_POST["harga"]);
    $gambar = htmlspecialchars($_FILES["gambar"]["name"]);
    $kategori = htmlspecialchars($_POST["kategori"]);
    $status = htmlspecialchars($_POST["status"]);
    $kode_menu = htmlspecialchars($_POST["kode_menu"]);

    $format_gambar = ["jpg", "jpeg", "png", "gif"];
    $cek_gambar = explode(".", $gambar);
    $cek_gambar = strtolower(end($cek_gambar));

    if (!in_array($cek_gambar, $format_gambar) && strlen($gambar) != 0) {
        echo "<script>
            alert('File yang diupload bukan merupakan image!');
        </script>";
        return -1;
    }

    $gambar_lama = $_POST["gambar-lama"];

    if (strlen($gambar) == 0) {
        $gambar = $gambar_lama;
    } else if ($gambar != $gambar_lama && strlen($gambar) != 0) {
        move_uploaded_file($_FILES["gambar"]["tmp_name"], "src/img/$gambar");
        unlink("src/img/$gambar_lama");
    }

    mysqli_query($koneksi, "UPDATE menu
                            SET kode_menu = '$kode_menu',
                                nama = '$nama',
                                harga = $harga,
                                gambar = '$gambar',
                                kategori = '$kategori',
                                `status` = '$status'
                            WHERE id_menu = $id_menu
    ");

    return mysqli_affected_rows($koneksi);
}

function hapus_data_menu()
{
    global $koneksi;

    $id_menu = $_GET["id_menu"];

    $file_gambar = ambil_data("SELECT * FROM menu WHERE id_menu = $id_menu")[0]["gambar"];

    if (file_exists("src/img/$file_gambar")) {
        unlink("src/img/$file_gambar");
    }

    mysqli_query($koneksi, "DELETE FROM menu
                            WHERE id_menu = $id_menu
    ");

    return mysqli_affected_rows($koneksi);
}

function tambah_data_pesanan()
{
    global $koneksi;

    $pelanggan = htmlspecialchars($_POST["pelanggan"]);
    $kode_pesanan = uniqid();

    $list_pesanan = [];

    $max_menu = count(ambil_data("SELECT * FROM menu"));

    for ($i = 1; $i <= $max_menu; $i++) {
        if (isset($_POST["qty$i"]) && (int)$_POST["qty$i"] != 0) {
            array_push($list_pesanan, [
                "kode_menu" => $_POST["kode_menu$i"],
                "qty" => (int)$_POST["qty$i"]
            ]);
        }
    }

    if (count($list_pesanan) == 0) {
        echo "<script>
            alert('Anda belum memesan menu!');
        </script>";
        return -1;
    }

    foreach ($list_pesanan as $lp) {
        $kode_menu = $lp["kode_menu"];
        $qty = $lp["qty"];
        mysqli_query($koneksi, "INSERT INTO pesanan
                                VALUES ('', '$kode_pesanan', '$kode_menu', $qty);
        ");
    }

    mysqli_query($koneksi, "INSERT INTO transaksi
                            VALUES ('', '$kode_pesanan', '$pelanggan', NOW())
    ");

    return mysqli_affected_rows($koneksi);
}

function hapus_data_pesanan()
{
    global $koneksi;

    $kode_pesanan = $_GET["kode_pesanan"];

    mysqli_query($koneksi, "DELETE FROM transaksi
                            WHERE kode_pesanan = '$kode_pesanan'
    ");

    mysqli_query($koneksi, "DELETE FROM pesanan
                            WHERE kode_pesanan = '$kode_pesanan'
    ");

    return mysqli_affected_rows($koneksi);
}
?>
