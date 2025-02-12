<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
class PaymentController extends Controller
{
    public function index(Payment $payment)
    {
        if(auth()->user()->level != 'admin'){
            return view('error');
        }
        
        $payments = $payment->with(['booking', 'menu', 'guest'])->paginate(10);
        return view('dashboard.payments.manage', compact('payments'));
    }
}
