@extends('layouts.dashboard.app')

@section('title', 'Data Pembelian')

@section('content')
    <main>
        <div class="container-fluid px-4 mt-4">
            <h4 class="my-4">Data Pembelian</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="{{ route('admin.pembelian.create') }}" class="btn btn-primary"><i
                            class="fa-solid fa-circle-plus"></i> Tambah Baru</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembelians as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ 'Rp. ' . number_format($item->harga, 2, ',', ',') }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ 'Rp. ' . number_format($item->total, 2, ',', ',') }}</td>
                                    <td>
                                        <form action="{{ route('admin.pembelian.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin menghapus data ini?')"><i
                                                    class="fas fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <div class="alert-body">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    </div>
                </div>
            @elseif($message = Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    <div class="alert-body">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    </div>
                </div>
            @endif
        </div>
        {{-- Category Modal --}}
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.menu.category.store') }}" method="POST">
                            @csrf
                            <label for="category_name">Nama Kategori <small class="text-danger">*</small></label>
                            <input type="text" name="category_name" id="category_name" class="form-control"
                                placeholder="Masukan nama kategori" required>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
