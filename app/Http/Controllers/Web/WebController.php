<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
class WebController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('web.welcome', compact('menus'));
    }
}
