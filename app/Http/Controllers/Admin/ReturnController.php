<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnController extends Controller
{
    public function index()
    {
        $status = 'Dibatalkan';
        $orders = Booking::where('status', $status)->get();
        return view('dashboard.return.manage', compact('orders'));
    }

    public function destory($id)
    {
        if(Booking::findOrFail($id)->delete()){
            return redirect()->back()->with('success', 'Berhasil menghapus data!');
        }else{
            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
        
    }
}
