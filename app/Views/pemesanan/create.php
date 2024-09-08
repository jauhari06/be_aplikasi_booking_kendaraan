<?= $this->extend('layouts/navbar'); ?>

<?= $this->section('content'); ?>
<style>

    body {
        font-family: Arial, sans-serif; 
    }
    h1 {
        color: #333;
    }
    form {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    form label {
        display: block;
        margin-bottom: 5px;
    }
    form select, form input {
        display: block;
        margin-bottom: 20px;
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }
    form button {
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    form button:hover {
        background-color: #444;
    }
</style>
<h1>Buat Pemesanan Baru</h1>
<form action="<?= base_url('pemesanan/store'); ?>" method="post">
    <?= csrf_field() ?>
    
    <label for="id_kendaraan">Pilih Kendaraan:</label>
    <select name="id_kendaraan" id="id_kendaraan">
        <?php foreach ($kendaraan as $item): ?>
            <option value="<?= $item->id; ?>"><?= $item->tipe; ?></option>
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