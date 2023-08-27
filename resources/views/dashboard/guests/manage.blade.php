@extends('layouts.dashboard.app')

@section('title', 'Guest')

@section('content')
<main>
    <div class="container-fluid px-4 mt-4">
        <h4 class="my-4">Daftar Tamu</h4>
        <div class="card mb-4">
            <div class="card-header">
                {{-- <a href="{{ route('admin.menu.new') }}" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Tambah Baru</a> --}}
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guests as $guest)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $guest->name }}</td>
                            <td>{{ $guest->email }}</td>
                            <td>{{ $guest->level }}</td>
                            {{-- <td>
                                <a href="{{ route('admin.menu.show', $menu->id) }}" data-toggle="tooltip" data-placement="bottom" title="Details"><i class="fa-solid fa-eye"></i></a>
                            </td> --}}
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
