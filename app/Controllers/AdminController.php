<?php

namespace App\Controllers;

use App\Models\PemesananModel;
use App\Models\PersetujuanModel;
use App\Models\UserModel;
use App\Models\KendaraanModel;

class AdminController extends BaseController
{
    protected $pemesananModel;
    protected $persetujuanModel;
    protected $userModel;
    protected $kendaraanModel;

    protected $session;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
        $this->persetujuanModel = new PersetujuanModel();
        $this->userModel = new UserModel();
        $this->kendaraanModel = new KendaraanModel();
        $this->session = \Config\Services::session();
    }

    public function login()
{
    $username = $this->request->getPost('username');
    $password = md5($this->request->getPost('password'));

   
    $user = $this->userModel->where('username', $username)
                            ->where('password', $password)
                            ->first();

    if ($user) {
        
        $this->session->set([
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
            'logged_in' => true
        ]);

    
        if ($user['role'] == 'admin') {
            return redirect()->to('/admin/admin_view');
        } else if ($user['role'] == 'approver') {
            return redirect()->to('/admin/approver_view');
        }
    } else {
        return redirect()->to('/admin/login')->with('error', 'Username atau password salah.');
    }
}

    public function index()
    {
        return view('admin/login');
    }

    public function admin_view()
    {
    if ($this->session->get('role') === 'admin') {
        $pemesanan = $this->pemesananModel->findAll();
        $kendaraan = $this->kendaraanModel->findAll();
        $approvers = $this->userModel->where('role', 'approver')->findAll();


        $data = [
            'pemesanan' => $pemesanan,
            'kendaraan' => $kendaraan,
            'approvers' => $approvers
        ];

        return view('admin/admin_view', $data);
    }

    return redirect()->to('/admin/login')->with('error', 'Akses ditolak.');
        }

    public function approver_view()
    {
    if ($this->session->get('role') === 'approver') {
        $pemesanan = $this->pemesananModel->findAll();
        $kendaraan = $this->kendaraanModel->findAll();
        $approvers = $this->userModel->where('role', 'approver')->findAll();

        $data = [
            'pemesanan' => $pemesanan,
            'kendaraan' => $kendaraan,
            'approvers' => $approvers
        ];

        return view('admin/approver_view', $data);
    }

    return redirect()->to('/admin/login')->with('error', 'Akses ditolak.');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login');
    }


    public function createUser()
    {
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $role = $this->request->getPost('role');
    $hashedPassword = md5($password);
    $data = [
        'username' => $username,
        'password' => $hashedPassword,
        'role' => $role,
    ];
    $this->userModel->insert($data);

    return redirect()->to('/admin/admin_view');
    }

    public function tambahKendaraan()
    {
    $kendaraanModel = new \App\Models\KendaraanModel();

    $tipe = $this->request->getPost('tipe');
    $BBM = $this->request->getPost('BBM');
    $penyewaan = $this->request->getPost('penyewaan');
    $servis = $this->request->getPost('servis');
    $riwayat_pemakaian = $this->request->getPost('riwayat_pemakaian');

    $kendaraanModel->insert([
        'tipe' => $tipe, 
        'BBM' => $BBM, 
        'penyewaan' => $penyewaan, 
        'servis' => $servis, 
        'riwayat_pemakaian' => $riwayat_pemakaian
    ]);

    return redirect()->to('/admin/admin_view');
    }

    public function delete_vehicle($id)
{
    $this->kendaraanModel->delete($id);
    return redirect()->to('/admin/admin_view');
}

    public function setujuiPemesanan($id)
{

    $pemesanan = $this->pemesananModel->find($id);
   $status = $this->request->getPost('status');

   $pemesanan = $this->pemesananModel->find($id);

   if ($pemesanan) {

       $this->pemesananModel->update($id, ['status' => $status]);


       $persetujuan = $this->persetujuanModel->where('id_pemesanan', $id)->first();
       if ($persetujuan) {

           $this->persetujuanModel->update($persetujuan['id'], ['status' => $status]);
       } else {

           die("id_pemesanan {$id} tidak ditemukan di tabel persetujuan");
       }
   }

   $pemesanan = $this->pemesananModel->findAll();
   $kendaraan = $this->kendaraanModel->findAll();
   $approvers = $this->userModel->where('role', 'approver')->findAll();

   return redirect()->to('/admin/admin_view')->with('data', [
       'pemesanan' => $pemesanan,
       'kendaraan' => $kendaraan,
       'approvers' => $approvers,
   ]);
}



public function create()
{

    $data['kendaraan'] = $this->kendaraanModel->findAll();
    $data['approvers'] = $this->userModel->where('role', 'approver')->findAll();

    return view('admin/admin_view', $data);
}


public function buatPemesanan()
{

    $id_kendaraan = $this->request->getPost('id_kendaraan');
    $pengemudi = $this->request->getPost('pengemudi');
    $id_persetujuan = $this->request->getPost('id_persetujuan');

    $id_users = $this->session->get('id');

    if ($id_users) {
        $dataPemesanan = [
            'id_users' => $id_users,
            'id_kendaraan' => $id_kendaraan,
            'pengemudi' => $pengemudi,
            'id_persetujuan' => $id_persetujuan,
            'status' => 'pending' 
        ];


        $id_pemesanan = $this->pemesananModel->insert($dataPemesanan);

 
        $dataPersetujuan = [
            'id_pemesanan' => $id_pemesanan,
            'id_persetujuan' => $id_persetujuan,
            'level' => 1, 
            'status' => 'pending' 
        ];

    
        $this->persetujuanModel->insert($dataPersetujuan);

       
        return redirect()->to('/admin/admin_view')->with('success', 'Pemesanan baru berhasil dibuat.');
    } else {
        return redirect()->to('/admin/login')->with('error', 'Anda harus login terlebih dahulu.');
    }
}
}