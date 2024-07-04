<table class="table table-bordered table-hover" style="margin-top: 100px;">

    <tr class="text-bg-success">
        <th>No</th>
        <th>Kode Pesanan</th>
        <th>Nama Pelanggan</th>
        <th>Waktu</th>
        <th>Total Harga</th>
        <th>Pembayaran</th>
        <th>Action</th> <!-- Kolom untuk tombol Cetak dan Hapus -->
    </tr>
    <?php 
    $i = 1;
    foreach ($menu as $m) {
        $kode_pesanan = $m["kode_pesanan"];
        $total_pembayaran = ambil_data("SELECT DISTINCT * FROM pesanan
            JOIN transaksi ON (pesanan.kode_pesanan = transaksi.kode_pesanan)
            JOIN menu ON (menu.kode_menu = pesanan.kode_menu)
            WHERE transaksi.kode_pesanan = '$kode_pesanan'");
        
        // Format kode pesanan dengan str_pad
        $kode_pesanan_formatted = "PSN" . str_pad($i, 3, '0', STR_PAD_LEFT);
    ?>

        <form action="cetak/cetak.php" target="_blank" method="GET">
            <input type="hidden" name="kode_pesanan" value="<?= $m["kode_pesanan"]; ?>">
            <tr style="background-color: white;">
                <td><?= $i; ?></td>
                <td><?= $kode_pesanan_formatted; ?></td>
                <td><?= $m["nama_pelanggan"]; ?></td>
                <td><?= $m["waktu"]; ?></td>
                <td>
                    <?php
                    $total = 0;
                    foreach ($total_pembayaran as $tp) {
                        $total += $tp["qty"] * $tp["harga"];
                    }
                    echo "Rp." . $total;
                    ?>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input name="pembayaran" min="0" type="number" class="form-control">
                    </div>
                </td>
                <td>
                    <!-- Tombol Cetak dengan ikon -->
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-printer"></i>
                    </button>
                    <!-- Tombol Hapus dengan ikon -->
                    <a class="btn btn-danger" href="hapus.php?kode_pesanan=<?= $m["kode_pesanan"]; ?>" onclick="return confirm('Hapus Data Transaksi?')">
                        <i class="bi bi-trash"></i> 
                    </a>
                </td>
            </tr>
        </form>
    <?php 
    $i++;
    } ?>
</table>
