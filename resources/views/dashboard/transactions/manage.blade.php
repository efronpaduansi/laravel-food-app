@extends('layouts.dashboard.app')

@section('title', 'Transaction List')

@section('content')
<main>
    <div class="container-fluid px-4 mt-4">
        <h4 class="my-4">Daftar Transaksi</h4>
        <div class="card mb-4">
            <div class="card-header text-right">
                <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete Batch</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pemesan</th>
                            <th>Menu</th>
                            <th>Qty</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->guest->name }}</td>
                                <td>{{ $item->menu->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->payment }}</td>
                                <td>{{ $item->payment_status }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <form action="{{ route('admin.transactions.delete') }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="orderId" id="orderId" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Yakin menghapus data ini?')"><i class="fas fa-times"></i></button>
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
