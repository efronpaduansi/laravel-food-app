@extends('layouts.dashboard.app')

@section('title', 'Payments')

@section('content')
<main>
    <div class="container-fluid px-4 mt-4">
        <h4 class="my-4">Data Pembayaran</h4>
        <div class="card mb-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tamu</th>
                            <th>Menu</th>
                            {{-- <th>Tgl Order</th> --}}
                            <th>Jumlah (Rp.)</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $pay)
                        <tr>
                            <td>{{ $pay->id }}</td>
                            <td>{{ $pay->guest->name }}</td>
                            <td>{{ $pay->menu->name }}</td>
                            {{-- <td>{{ $pay->booking->created_at }}</td> --}}
                            <td>{{ "Rp. " . number_format($pay->amount, 2, ',', '.') }}</td>
                            <td>{{ $pay->method }}</td>
                            <td>
                                <span class="badge badge-success">{{ $pay->status }}</span>
                            </td>
                            <td>
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin menghapus data ini?')"><i class="fas fa-times"></i></button>
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
</main>
@endsection
