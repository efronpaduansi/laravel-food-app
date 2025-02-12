<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    
    public function index()
    {
        if(auth()->user()->level != 'admin'){
            return view('error');
        }
        
        $statusWaitingConfirm = 'Diterima';
        $statusDone = 'Selesai';
        $statusCancelled = 'Dibatalkan';
        $totalMenu = Menu::latest()->count();
        $orderWaitingConfirm = Booking::where('status', $statusWaitingConfirm)->count();
        $orderDone = Booking::where('status', $statusDone)->count();
        $orderCancelled = Booking::where('status', $statusCancelled)->count();
        return view('dashboard.index', compact('totalMenu', 'orderWaitingConfirm', 'orderDone', 'orderCancelled'));
    }
}
