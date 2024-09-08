<?php

namespace App\Models;
use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tipe', 'penyewaan', 'BBM', 'servis', 'riwayat_pemakaian'];
}