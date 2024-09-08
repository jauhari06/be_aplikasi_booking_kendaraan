<?php

namespace App\Controllers;

use App\Models\PemesananModel;

class PersetujuanController extends BaseController
{
    protected $pemesananModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
    }

    public function index()
    {
        $pemesanan = $this->pemesananModel->findAll();
        return view('persetujuan/index', ['pemesanan' => $pemesanan]);
    }
}