<?php

namespace App\Models;
use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_users', 'id_kendaraan', 'pengemudi', 'id_persetujuan', 'status'];

    public function getBookings()
    {
        return $this->select('pemesanan.*, kendaraan.tipe, users.username as pengemudi')
                    ->join('kendaraan', 'kendaraan.id = pemesanan.id_kendaraan')
                    ->join('users', 'users.id = pemesanan.id_users')
                    ->findAll();
    }

    public function getBookingsWithApprover()
{
    return $this->select('pemesanan.*, kendaraan.tipe, approver.username as approver')
                ->join('kendaraan', 'kendaraan.id = pemesanan.id_kendaraan')
                ->join('users as approver', 'approver.id = pemesanan.id_persetujuan')
                ->findAll();
}
}