@extends('layouts.dashboard.app')

@section('title', 'Orders List')

@section('content')
<main>
    <div class="container-fluid px-4 mt-4">
        <h4 class="my-4">Daftar Pesanan</h4>
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
                            <th>Catatan</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderList as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->guest->name }}</td>
                                <td>{{ $item->menu->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->payment }}</td>
                                <td>{{ $item->payment_status }}</td>
                                 @if ($item->status == 'Dibatalkan')
                                     <td>
                                        <button type="submit" class="btn btn-sm btn-danger disabled">{{ $item->status }}</button>
                                     </td>
                                 @else
                                    <td>
                                        {{-- Dropdown status changer --}}
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                            {{ $item->status }}
                                            </button>
                                            <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.order-status-processed', $item->id) }}">Diproses</a>
                                            <a class="dropdown-item" href="{{ route('admin.order-status-change-to-done', $item->id) }}">Selesai</a>
                                            <a class="dropdown-item text-danger" href="{{ route('admin.order-status-change-to-cancel', $item->id) }}" onclick="return confirm('Anda yakin membatalkan pesanan ini?')">Dibatalkan</a>
                                            </div>
                                        </div>
                                    </td>
                                 @endif
                                <td>
                                    <form action="{{ route('admin.order-delete-by-id') }}" method="POST">
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
