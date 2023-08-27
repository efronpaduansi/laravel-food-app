<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Menu;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function newBook($id)
    {
        $menu   = Menu::find($id);
        return view('guest.booking.new', compact('menu'));
    }

    public function bookStore(Request $request, Payment $payment)
    {
        try{
            $validated = Validator::make($request->all(), [
                'qty' => 'required|numeric|max:3',
                'payment' => 'required'
            ], [
                'qty.required' => 'Bidang ini wajib di isi!',
                'qty.numeric' => 'Jumlah hanya boleh di isi angka!',
                'payment.required' => 'Bidang ini wajib di isi!'
            ]);
            if($validated->fails()){
                return redirect()->back()->withErrors($validated);
            }
            Booking::create([
                'guest_id' => $request->guest_id,
                'menu_id' => $request->menu_id,
                'qty' => $request->qty,
                'total' => $request->qty * $request->menu_price,
                'status' => 'Diterima',
                'note' => $request->note,
                'payment' => $request->payment,
                'payment_status' => 'Lunas'
            ]);

            //Jika berhasil maka masukan data ke table payments
            $data = [
                'guest_id' => $request->guest_id,
                'menu_id' => $request->menu_id,
                'booking_id' => Booking::latest()->first()->id,
                'amount' => $request->qty * $request->menu_price,
                'method' => $request->payment,
                'status' => 'Lunas'
            ];
            $payment->create($data);
            //Jika sudah update menu
            $menu = Menu::find($request->menu_id);
            $menu->stock = $menu->stock - $request->qty;
            $menu->update();
            return redirect()->route('guest.home')->with('success', 'Pesanan anda berhasil dikirim ke koki. Mohon untuk menunggu beberapa menit!');

        }catch (\Throwable $err){
            throw $err;
        }
    }

    //Batalkan pesanan
    public function canceled(Request $request, $id)
    {
        try{
            $orderData = Booking::find($id);
            $orderData->status = 'Dibatalkan';
            $orderData->update();
            return redirect()->route('guest.home')->with('success', 'Pesanan anda berhasil dibatalkan!');
        }catch (\Throwable $err){
            throw $err;
        }
    }
}
