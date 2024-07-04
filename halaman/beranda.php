<!-- Pemesanan -->
<form action="index.php" method="POST">
    <div class="d-flex">
        <input class="form-control mx-sm-2 my-2 w-auto" type="text" name="pelanggan" placeholder="Nama Pelanggan" required autocomplete="off">
        <button class="btn btn-success my-2 mx-2 menu-category" name="pesan">Pesan</button>
    </div>

    <!-- Menu Masakan -->
    <div class="row">
        <?php 
        $i = 1;
        foreach ($menu as $m) { ?>
            <div class="col-sm-4 mx-auto m-2">
                <div class="card">
                    <h5 class="card-header tb-menu"><?= $m["nama"]; ?></h5>
                    <div class="card-body">
                        <input type="hidden" name="kode_menu<?= $i; ?>" value="<?= $m["kode_menu"]; ?>">
                        <table class="table table-bordered table-hover table-white"> <!-- Tambahkan kelas table-white untuk latar belakang putih -->
                            <tr>
                                <td>Harga</td>
                                <td>:</td>
                                <td class="card-text tb-menu">Rp<?= $m["harga"]; ?></td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td class="card-text"><?= $m["kategori"]; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td class="card-text"><?= $m["status"]; ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td>:</td>
                                <td class="card-text"><input min="0" type="number" name="qty<?= $i; ?>"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php $i++; } ?>
    </div>
</form>
