<?= $this->extend('layouts/navbar'); ?>

<?= $this->section('content'); ?>
<style>
    body {
        font-family: Arial, sans-serif; 
    }
    h1, h2 {
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
    .id-column {
        width: 50px; 
    }
    #PemakaianKendaraan {
        margin-top: 20px;
    }
</style>
<h1>Dashboard - Pemakaian Kendaraan</h1>

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
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<h2>Grafik Booking Kendaraan</h2>
<canvas id="PemakaianKendaraan"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('PemakaianKendaraan').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Order (Disetujui)', 'Jumlah Mobil', 'Total Pemesanan'],
        datasets: [{
            label: 'Count',
            data: [<?= $numOrders ?>, <?= $numUsedVehicles ?>, <?= $totalOrders ?>],
            backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
            borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<?= $this->endSection(); ?>