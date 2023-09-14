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

    public function create()
    {
        return view('dashboard.pembelian.create');
    }

    public function store(Request $request)
    {
        $data = [
            'nama_barang' => $request->nama_barang,
            'harga'     => $request->harga,
            'jumlah' => $request->jumlah,
            'total' => $request->harga * $request->jumlah
        ];
        if(Pembelian::create($data)){
            return redirect()->route('admin.pembelian')->with('success', 'Berhasil menambahkan data');
        }else{
            return redirect()->back()->with('error', 'Gagal menambahkan data');
            
        }
    }

    public function edit($id)
    {
        $pembelian = Pembelian::findOrFail($id)->first();
        return view('dashboard.pembelian.edit', compact('pembelian'));
        
    }

    public function update(Request $request)
    {
        $data = [
            'nama_barang' => $request->nama_barang,
            'harga'     => $request->harga,
            'jumlah' => $request->jumlah,
            'total' => $request->harga * $request->jumlah
        ];

        $id = $request->id;
        if(Pembelian::findOrFail($id)->update($data)){
            return redirect()->route('admin.pembelian')->with('success', 'Berhasil mengubah data');
        }else{
            return redirect()->route('admin.pembelian')->with('error', 'Gagal mengubah data');
        }
    }

    public function destroy(Request $request)
    {
        if(Pembelian::findOrFail($request->id)->delete()){
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        }else{
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
