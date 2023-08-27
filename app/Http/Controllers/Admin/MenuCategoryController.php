<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuCategory;
class MenuCategoryController extends Controller
{
    public function index(){
        return view('dashboard.menu_category.manage');
    }
}
