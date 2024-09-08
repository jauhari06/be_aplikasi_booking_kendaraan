<?php namespace App\Controllers;

use App\Models\PemesananModel;
use App\Models\PersetujuanModel;

class ApproverController extends BaseController
{
    protected $pemesananModel;
    protected $persetujuanModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
        $this->persetujuanModel = new PersetujuanModel();
    }

    public function index()
{
    $data['pemesanan'] = $this->pemesananModel->select('pemesanan.*, persetujuan.level')
        ->join('persetujuan', 'persetujuan.id_pemesanan= pemesanan.id')
        ->findAll();
    return view('admin/approver_view', $data);
}

public function setujuiPemesanan($id)
{

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

   return redirect()->to('/admin/approver_view');
}
}