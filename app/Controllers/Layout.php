<?php

namespace App\Controllers;

use App\Models\KendaraanModel;

class Layout extends BaseController
{
    protected $kendaraanModel;

    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
    }

    public function index()
    {
        
        return view('layouts/navbar');
    }
}
