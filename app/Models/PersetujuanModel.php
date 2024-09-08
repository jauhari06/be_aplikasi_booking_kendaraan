<?php

namespace App\Models;
use CodeIgniter\Model;

class PersetujuanModel extends Model
{
    protected $table = 'persetujuan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pemesanan', 'id_persetujuan', 'level', 'status'];
}
