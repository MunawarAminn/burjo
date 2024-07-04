<table class="table table-bordered table-hover table-white" style="margin-top: 100px;">
    <tr class="text-bg-success table-white">
        <th>No</th>
        <th>Kode Pesanan</th>
        <th>Nama Pelanggan</th>
        <th>Kode Menu</th>
        <th>Jumlah</th>
    </tr>
    <?php 
    $i = 1; 
    foreach ($menu as $m) {
        // Format kode pesanan dengan PSN dan angka berurutan
        $kode_pesanan = 'PSN' . str_pad($i, 3, '0', STR_PAD_LEFT);
        ?>
        <tr class="table-white">
            <td><?= $i; ?></td>
            <td><?= $kode_pesanan; ?></td>
            <td><?= $m["nama_pelanggan"]; ?></td>
            <td><?= $m["kode_menu"]; ?></td>
            <td><?= $m["qty"]; ?></td>
        </tr>
        <?php $i++; ?>
    <?php } ?>
</table>
