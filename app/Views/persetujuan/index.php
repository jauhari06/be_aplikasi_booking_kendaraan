<?= $this->extend('layouts/navbar'); ?>

<?= $this->section('content'); ?>
<style>
    body {
        font-family: Arial, sans-serif; 
    }
    h1 {
        color: #333;
    }
    table {
        width: 100%;
        margin-top: 20px;
        table-layout: fixed;
        border-collapse: collapse;
    }
    table th, table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ccc;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
<h1>Daftar Persetujuan</h1>
<table border="1">
    <tr>    
        <th>ID</th>
        <th>Kendaraan</th>
        <th>Pengemudi</th>
        <th>Status</th>
    </tr>
    <?php foreach ($pemesanan as $item): ?>
        <tr>
            <td><?= $item['id']; ?></td>
            <td><?= $item['id_kendaraan']; ?></td>
            <td><?= $item['pengemudi']; ?></td>
            <td><?= ucfirst($item['status']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection(); ?>