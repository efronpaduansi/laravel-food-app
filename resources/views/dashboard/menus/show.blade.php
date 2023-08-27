@extends('layouts.dashboard.app')

@section('title', 'Detail Menu')

@section('content')
<main>
    <div class="container-fluid px-4 mt-4">
        <h4 class="my-4">Detail Menu</h4>
        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('admin.menu') }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('images/menu/' . $menu->thumbnail) }}" height="400px" width="400px">
                <h4 class="my-4">{{ $menu->name }}</h4>
                <p class="my-2">{{ $menu->category }}</p>
                <p class="my-2">Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
                <div class="tombol d-flex justify-content-center mt-3">
                    <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-sm btn-warning mr-4">Edit</a>
                    <form action="{{ route('admin.menu.delete', $menu->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin menghapus data ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
