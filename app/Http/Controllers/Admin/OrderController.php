<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
class OrderController extends Controller
{
    public function index(){
     if(auth()->user()->level != 'admin'){
          return view('error');
      }
      
        $orderList = Booking::orderBy('id', 'desc')->get();
        return view('dashboard.orders.manage', compact('orderList'));
    }

    public function deleteById(Request $request){
        $orderData = Booking::find($request->orderId)->first();
        $orderData->delete();
        return redirect()->route('admin.order')->with('success', 'Pesanan berhasil dihapus!');
    }

   public function statusChangeToProcessed($id){
        $affected = Booking::find($id);
        $affected->status = 'Sedang Diproses';
        $affected->update();
        return redirect()->route('admin.order')->with('success', 'Status pesanan diubah ke Sedang DiProses!');
   }

   public function statusChangeToDone($id){
        $affected = Booking::find($id);
        $affected->status = 'Selesai';
        $affected->update();
        return redirect()->route('admin.order')->with('success', 'Status pesanan diubah ke Selesai!');
   }

   public function statusChangeToCancel($id){
        $affected = Booking::find($id);
        $affected->status = 'Dibatalkan';
        $affected->update();
        return redirect()->route('admin.order')->with('success', 'Status pesanan diubah ke Dibatalkan!');
   }
}
