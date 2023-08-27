<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class GuestController extends Controller
{
    public function index()
    {
        $myBookingList  = Booking::where('guest_id', auth()->user()->id)->get();
        $userData       = User::where('id', auth()->user()->id)->first();
        return view('guest.index', compact('myBookingList', 'userData'));
    }

    //Profile Update
    public function profileUpdate(Request $request){
        $affected = User::find($request->id);
        $affected->name = $request->fullname;
        $affected->email = $request->email;
        $affected->update();
        return redirect()->back()->with('success', 'Profile berhasil diupdate');
    }
    
    //Guest Password Update
    public function passUpdate(Request $request){
        $affected = User::find($request->id);
        //verify password
        if(Hash::check($request->oldPass, $affected->password)){
            if($request->newPass === $request->passConf){
                $affected->password = Hash::make($request->newPass);
                $affected->update();
                return redirect()->back()->with('success', 'Password berhasil diupdate');
            }else{
                return redirect()->back()->with('error', 'Gagal mengupdate. Password tidak sama!');
            }
        }else{
            return redirect()->back()->with('error', 'Gagal mengupdate. Password tidak sama!');
        }
    }
    
}
