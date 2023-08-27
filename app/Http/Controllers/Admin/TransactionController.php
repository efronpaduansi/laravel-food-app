<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
class TransactionController extends Controller
{
    public function index(Booking $booking)
    {
        //Ambil data dari tabel bookings where status = Selesai
        $transactions = $booking->where('status', 'Selesai')->get();
        return view('dashboard.transactions.manage', compact('transactions'));
    }

    public function deleteById(Request $request){
        $orderData = Booking::find($request->orderId)->first();
        $orderData->delete();
        return redirect()->route('admin.transactions')->with('success', 'Pesanan berhasil dihapus!');
    }
}
