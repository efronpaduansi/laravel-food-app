@extends('layouts.dashboard.app')

@section('title', 'Return')

@section('content')
    <main>
        <div class="container-fluid px-4 mt-4">
            <h4 class="my-4">Order Return</h4>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Nama Pemesan</th>
                                <th>Menu</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d-m-y H:i:s', strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->guest->name }}</td>
                                    <td>{{ $item->menu->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ 'Rp. ' . number_format($item->total, 2, '.', ',') }}</td>
                                    <td>
                                        <span class="badge badge-danger">
                                            {{ $item->status }}
                                        </span>
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