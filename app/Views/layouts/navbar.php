<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Aplikasi Pemesanan Kendaraan'; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif; 
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?= base_url('/dashboard'); ?>">Dashboard</a></li>
            <li><a href="<?= base_url('/pemesanan'); ?>">Pemesanan</a></li>
            <li><a href="<?= base_url('/persetujuan'); ?>">Persetujuan</a></li>
            <li><a href="<?= base_url('/report/generate'); ?>">Download Laporan</a></li>
            <li><a href="<?= base_url('/admin/login'); ?>">Login</a></li>
        </ul>
    </nav>

    <div class="content">
        <?= $this->renderSection('content'); ?>
    </div>
</body>
</html>
