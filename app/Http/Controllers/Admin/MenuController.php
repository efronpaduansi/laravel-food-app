<?php

namespace App\Http\Controllers\Admin;

use DB;
use Session;
use Validator;
use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('dashboard.menus.manage', compact('menus'));
    }

    public function create()
    {
        $categories = MenuCategory::latest()->get();
        return view('dashboard.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'menu_img'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'menu_name'      => 'required',
            'menu_category'  => 'required',
            'menu_stock'     => 'required|numeric',
            'menu_price'     => 'required|numeric',
        ],[
            'menu_img.required'      => 'Gambar menu tidak valid',
            'menu_name.required'     => 'Nama menu harus diisi',
            'menu_category.required' => 'Kategori menu harus diisi',
            'menu_stock.required'    => 'Stok menu harus diisi',
            'menu_stock.numeric'    => 'Stok menu harus berupa angka',
            'menu_price.required'    => 'Harga menu harus diisi',
            'menu_price.numeric'    => 'Harga menu harus berupa angka',
        ]);
         if($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput();
         }
         $imageName = time() . rand() . '.'.$request->menu_img->extension();
         $request->menu_img->move(public_path('images/menu'), $imageName);

        $menu = new Menu();
        $menu->category_id = $request->menu_category;
        $menu->thumbnail = $imageName;
        $menu->name = $request->menu_name;
        $menu->stock = $request->menu_stock;
        $menu->price = $request->menu_price;
        $menu->save();
        
        return redirect('/menu')->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        return view('dashboard.menus.show', compact('menu'));
    }

    public function edit($id)
    {
        $categories = MenuCategory::latest()->get();
        $menu = Menu::find($id);
        return view('dashboard.menus.edit', compact('categories','menu'));
    }

    public function update(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'menu_name'      => 'required',
            'menu_category'  => 'required',
            'menu_stock'     => 'required|numeric',
            'menu_price'     => 'required|numeric',
        ],[
            'menu_name.required'     => 'Nama menu harus diisi',
            'menu_category.required' => 'Kategori menu harus diisi',
            'menu_stock.required'    => 'Stok menu harus diisi',
            'menu_stock.numeric'    => 'Stok menu harus berupa angka',
            'menu_price.required'    => 'Harga menu harus diisi',
            'menu_price.numeric'    => 'Harga menu harus berupa angka',
        ]);

        //jika ada gambar yang diupload
        if($request->hasFile('menu_img')){
            $validated = Validator::make($request->all(), [
                'menu_img'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ],[
                'menu_img.required'      => 'Gambar menu tidak valid',
            ]);
            if($validated->fails()){
                return redirect()->back()->withErrors($validated)->withInput();
            }
            $imageName = time() . rand() . '.'.$request->menu_img->extension();
            $request->menu_img->move(public_path('images/menu'), $imageName);

            $menu               = Menu::find($request->menu_id);
            $menu->thumbnail    = $imageName;
            $menu->name         = $request->menu_name;
            $menu->category     = $request->menu_category;
            $menu->stock        = $request->menu_stock;
            $menu->price        = $request->menu_price;
            $menu->update();
        }else{
            $menu               = Menu::find($request->menu_id);
            $menu->name         = $request->menu_name;
            $menu->category     = $request->menu_category;
            $menu->stock        = $request->menu_stock;
            $menu->price        = $request->menu_price;
            $menu->update();
        }
        return redirect('/menu')->with('success', 'Berhasil mengubah data!');
    }

}
