<?= $this->extend('layouts/navbar'); ?>

<?= $this->section('content'); ?>
<style>
   
    body {
        font-family: Arial, sans-serif; 
    }
    h1, h2, h3, h4 {
        color: #333;
    }
    form {
        margin-bottom: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    form input, form select, form textarea {
        display: block;
        margin-bottom: 10px;
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }
    table {
        width: 100%;
        margin-bottom: 20px;
        table-layout: fixed;
    }
    .id-column {
        width: 50px; 
    }
    table th, table td {
        padding: 10px;
        text-align: left;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
<h1>Dashboard Admin</h1>

<a href="/admin/logout">Logout</a>

<h2>Buat User Baru</h2>
<form action="/admin/createUser" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <label for="role">Role:</label><br>
    <select id="role" name="role">
        <option value="admin">Admin</option>
        <option value="approver">Approver</option>
    </select><br>
    <input type="submit" value="Create User">
</form>

<h2>Tambah Kendaraan Baru</h2>
<form action="/admin/tambahkendaraan" method="post">
    <label for="tipe">Tipe:</label>
    <select id="tipe" name="tipe">
        <option value="barang">Barang</option>
        <option value="penumpang">Penumpang</option>
    </select>

    <label for="BBM">Konsumsi BBM (L/km):</label>
    <input type="text" id="BBM" name="BBM" required>

    <label for="penyewaan">Disewakan:</label>
    <select id="penyewaan" name="penyewaan">
        <option value="yes">Iya</option>
        <option value="no">Tidak</option>
    </select>

    <label for="servis">Jadwal Servis:</label>
    <input type="date" id="servis" name="servis" required>

    <label for="riwayat_pemakaian">Riwayat Pemakaian:</label>
    <textarea id="riwayat_pemakaian" name="riwayat_pemakaian" required></textarea>

    <button type="submit">Tambah</button>
</form>


<h2>Daftar Informasi Kendaraan</h2>
<table border="1">
    <thead>
        <tr>
            <th class="id-column">No</th>
            <th class="id-column">ID</th>
            <th>Tipe</th>
            <th>BBM</th>
            <th>Jadwal Servic</th>
            <th>Riwayat Pemakaian</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($kendaraan as $vehicle): ?>
        <tr>
            <td style="border-width: thin;"><?= $no++; ?></td>
            <td class="id-column"><?= $vehicle['id']; ?></td>
            <td><?= ucfirst($vehicle['tipe']); ?></td>
            <td><?= $vehicle['BBM']; ?> L/km</td>
            <td><?= $vehicle['servis']; ?></td>
            <td><?= $vehicle['riwayat_pemakaian']; ?></td>
            <td>
                <a href="/admin/delete_vehicle/<?= $vehicle['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<h2>Daftar Pemesanan</h2>
<table border="1">
    <tr>
        <th class="id-column">ID</th>
        <th>Kendaraan</th>
        <th>Pengemudi</th>
        <th>Status</th>
        <th>Setujui</th>
    </tr>
    <?php foreach ($pemesanan as $item): ?>
        <tr>
            <td class="id-column"><?= $item['id']; ?></td>
            <td><?= $item['id_kendaraan']; ?></td>
            <td><?= $item['pengemudi']; ?></td>
            <td><?= ucfirst($item['status']); ?></td>
            <td>
            <form action="/admin/setujuipemesanan/<?= $item['id']; ?>" method="post">
                    <select name="status">
                        <option value="ditunda">Ditunda</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <button type="submit">Ubah Status</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<h1>Buat Pemesanan Baru</h1>
<form action="<?= base_url('admin/buatPemesanan'); ?>" method="post">
    <?= csrf_field() ?>
    
    <label for="id_kendaraan">Pilih Kendaraan:</label>
    <select name="id_kendaraan" id="id_kendaraan">
        <?php foreach ($kendaraan as $item): ?>
            <option value="<?= $item['id']; ?>"><?= $item['tipe']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="pengemudi">Pengemudi:</label>
    <input type="text" name="pengemudi" required>

    <label for="id_persetujuan">Pilih Approver:</label>
    <select name="id_persetujuan">
        <?php foreach ($approvers as $item): ?>
            <option value="<?= $item['id']; ?>"><?= $item['username']; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Simpan</button>
</form>
<?= $this->endSection(); ?>
