<h1>Laporan Pemesanan</h1>
<table border="1">
    <tr>
        <th>ID Pemesanan</th>
        <th>Pengemudi</th>
        <th>Tanggal Pemesanan</th>
    </tr>
    <?php foreach ($pemesanan as $item): ?>
        <tr>
            <td><?= $item['id']; ?></td>
            <td><?= $item['pengemudi']; ?></td>
            <td><?= $item['created_at']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
