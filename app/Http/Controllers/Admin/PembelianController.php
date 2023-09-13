<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::latest()->get();
        return view('dashboard.pembelian.manage', compact('pembelians'));
    }
}
