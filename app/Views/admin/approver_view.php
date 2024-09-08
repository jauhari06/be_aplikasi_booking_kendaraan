<?= $this->extend('layouts/navbar'); ?>

<?= $this->section('content'); ?>

<style>
    body {
        font-family: Arial, sans-serif; 
    }
    h1, h2, h3, h4 {
        color: #333;
    }
    a {
        color: #333;
        text-decoration: none;
    }
    table {
        width: 100%;
        margin-bottom: 20px;
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
    form {
        display: flex;
        align-items: center;
    }
    form select {
        margin-right: 10px;
    }
</style>

<h1>Dashboard Approver</h1>

<a href="/admin/logout">Logout</a>

<h3>Daftar Pemesanan</h3>
<table border="1">
<tr>
    <th>ID</th>
    <th>Kendaraan</th>
    <th>Pengemudi</th>
    <th>Status</th>
    <th>Setujui</th>
</tr>
<?php foreach ($pemesanan as $item): ?>
    <tr>
        <td><?= $item['id']; ?></td>
        <td><?= $item['id_kendaraan']; ?></td>
        <td><?= $item['pengemudi']; ?></td>
        <td><?= ucfirst($item['status']); ?></td>
        <td>
            <form action="/approver/setujuipemesanan/<?= $item['id']; ?>" method="post">
                <?= csrf_field() ?>
                <select name="status">
                    <option value="ditunda" <?= $item['status'] == 'ditunda' ? 'selected' : '' ?>>Ditunda</option>
                    <option value="disetujui" <?= $item['status'] == 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
                    <option value="ditolak" <?= $item['status'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                </select>
                <button type="submit">Ubah Status</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</table>
<?= $this->endSection(); ?>