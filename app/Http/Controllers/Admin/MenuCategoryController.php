<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuCategory;
class MenuCategoryController extends Controller
{
    public function index(){
        if(auth()->user()->level != 'admin'){
            return view('error');
        }
        $categories = MenuCategory::all();
        return view('dashboard.menu_category.manage', compact('categories'));
    }

    public function store(Request $request){
        $data = [
            'category_name' => $request->category_name,
        ];
        if(MenuCategory::create($data)){
            return redirect()->back()->with('success', 'Berhasil menambahkan data!');
        }else{
            return redirect()->back()->with('error', 'Gagal menambahkan data!');
        }
    }

    public function destroy(Request $request)
    {
        if(MenuCategory::findOrFail($request->id)->delete()){
            return redirect()->back()->with('success', 'Pesanan berhasil dihapus!');
        }else{
            return redirect()->back()->with('error', 'Pesanan berhasil dihapus!');

        }
    }
}
