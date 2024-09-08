<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\PemesananModel;

class DashboardController extends BaseController
{
    protected $kendaraanModel;
    protected $pemesananModel; 

    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
        $this->pemesananModel = new PemesananModel();
    }


    public function index()
    {
        $db = \Config\Database::connect();

        $query = $db->query('SELECT COUNT(*) as count FROM pemesanan WHERE status = "disetujui"');
        $numOrders = $query->getRow()->count;

        $query = $db->query('SELECT COUNT(*) as count FROM kendaraan WHERE riwayat_pemakaian IS NOT NULL');
        $numUsedVehicles = $query->getRow()->count;

        $totalOrders = $this->pemesananModel->countAll();

        $kendaraan = $this->kendaraanModel->findAll();

        return view('dashboard/index', ['kendaraan' => $kendaraan, 'numOrders' => $numOrders, 'numUsedVehicles' => $numUsedVehicles, 'totalOrders' => $totalOrders]);
    }
}