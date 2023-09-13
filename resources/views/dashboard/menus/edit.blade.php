@extends('layouts.dashboard.app')

@section('title', 'Menu')

@section('content')
    <main>
        <div class="container-fluid px-4 mt-4">
            <h4 class="my-4">Edit Menu</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="{{ route('admin.menu.show', $menu->id) }}" class="btn btn-sm btn-secondary"><i
                            class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.menu.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="menu_name">Menu</label>
                                <input type="text" name="menu_name" id="menu_name"
                                    class="form-control my-1 @error('menu_name') is-invalid @enderror"
                                    placeholder="Masukan nama menu" value="{{ $menu->name }}">
                                @error('menu_name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="menu_category">Kategori</label>
                                <select name="menu_category" id="menu_category"
                                    class="form-control my-1 @error('menu_category') is-invalid @enderror" required>
                                    <option value="" disabled selected hidden>{{ $menu->category->category_name }}
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                    @error('menu_category')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="menu_stock">Stok</label>
                                <input type="text" name="menu_stock" id="menu_stock"
                                    class="form-control my-1 @error('menu_stock') is-invalid @enderror"
                                    value="{{ $menu->stock }}">
                                @error('menu_stock')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="menu_price">Harga</label>
                                <input type="text" name="menu_price" id="menu_price"
                                    class="form-control my-1 @error('menu_price') is-invalid @enderror"
                                    value="{{ $menu->price }}">
                                @error('menu_price')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="menu_img">Thumbnail</label>
                                <input type="file" name="menu_img" id="menu_img"
                                    class="form-control my-1 @error('menu_img') is-invalid @enderror">
                                <small class="text-danger">Kosongkan jika tidak ingin mengganti gambar!</small>
                                @error('menu_img')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="tombol d-inline justify-content-left">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                                Submit</button>
                            <a href="{{ route('admin.menu.show', $menu->id) }}" class="btn btn-danger"><i
                                    class="fa-solid fa-rotate-left"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
