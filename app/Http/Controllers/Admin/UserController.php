<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function getAllGuest()
    {
        $guests = User::where('level', 'guest')->get();
        return view('dashboard.guests.manage', compact('guests'));
    }
}
