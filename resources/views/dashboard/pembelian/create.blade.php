@extends('layouts.dashboard.app')

@section('title', 'Data Pembelian')

@section('content')
    <main>
        <div class="container-fluid px-4 mt-4">
            <h4 class="my-4">Tambah Data Pembelian</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="{{ route('admin.pembelian') }}" class="btn btn-sm btn-secondary"><i
                            class="fa-solid fa-arrow-left"></i>
                        Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pembelian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang"
                                    class="form-control my-1 @error('nama_barang') is-invalid @enderror" autofocus
                                    placeholder="Masukan nama menu" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" id="harga" class="form-control"
                                    placeholder="Masukan harga" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control"
                                    placeholder="Masukan jumlah belanja" required>
                            </div>
                        </div>
                        <div class="tombol d-inline justify-content-left">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                                Submit</button>
                            <a href="{{ route('admin.pembelian') }}" class="btn btn-danger"><i
                                    class="fa-solid fa-rotate-left"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
