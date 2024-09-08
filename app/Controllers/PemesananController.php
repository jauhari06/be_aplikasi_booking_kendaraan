<?php

namespace App\Controllers;

use App\Models\PemesananModel;
use App\Models\PersetujuanModel;
use App\Models\KendaraanModel;
use App\Models\UserModel;

class PemesananController extends BaseController
{
    public function create()
    {
        $db = \Config\Database::connect();
        $userModel = new UserModel();
    
        $query = $db->query('SELECT * FROM kendaraan WHERE id NOT IN (SELECT id_kendaraan FROM pemesanan WHERE status IN ("disetujui", "tertunda"))');
        $data['kendaraan'] = $query->getResult();
    
        $data['approvers'] = $userModel->where('role', 'approver')->findAll();
        return view('pemesanan/create', $data);
    }

    public function store()
{
    $pemesananModel = new PemesananModel();
    $persetujuanModel = new PersetujuanModel();
    $data = $this->request->getPost();
    $data['id_users'] = $data['id_persetujuan']; 
    $pemesananModel->insert($data);
    
    $id_pemesanan = $pemesananModel->insertID();
    
    $persetujuanData = [
        'id_pemesanan' => $id_pemesanan,
        'id_persetujuan' => $data['id_persetujuan'],
        'level' => 'level 1', 
        'status' => 'ditunda' 
    ];
    $persetujuanModel->insert($persetujuanData);

    return redirect()->to('/pemesanan/create');
}
}