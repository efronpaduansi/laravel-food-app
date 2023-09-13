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
}
